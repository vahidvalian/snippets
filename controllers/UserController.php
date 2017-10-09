<?php

namespace app\controllers;

use app\models\UserConfig;
use Yii;
use yii\filters\AccessControl;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ServerErrorHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'activation', 'confirmation'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'change-password', 'settings'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['index', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],

        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {
        $id = Yii::$app->user->id;
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->setScenario('insert');
        if (
            $model->load(Yii::$app->request->post()) &&
            Yii::$app->recaptcha->verifyResponse($_SERVER['REMOTE_ADDR'], Yii::$app->request->post('g-recaptcha-response')) &&
            $model->save()
        ) {

            $message = Yii::$app->mailer->compose('user/activation', ['model' => $model]);
            $message->setFrom('info@snippets.ir');
            $message->setSubject('snippets.ir activation link');
            $message->setTo($model->email);

            $result = $message->send();

            return $this->redirect(['confirmation']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionActivation($token)
    {

        $model = User::find()->where('auth_key = :auth_key and is_active = 0', [':auth_key' => $token])->one();

        if($model) {
            $model->regenerateAuthKey();
            $model->is_active = 1;
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'thank you for active your account, now you can use snippets.ir');
                return $this->redirect(['site/login']);
            }else{
                throw new ServerErrorHttpException('Oh no! Something has gone wrong');
            }
        }else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionChangePassword()
    {
        $id = Yii::$app->user->id;
        $model = $this->findModel($id);

        $model->setScenario('change-password');

        $model->tmp_current_password = $model->password;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash("success", "your password has been successfully changed!");

            #TOOD: SEND EMAIL WHEN PASSWORD CHANGED

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->password = $model->password_repeat = '';
            return $this->render('change-password', [
                'model' => $model,
            ]);
        }
    }

    public function actionSettings()
    {
        $id = Yii::$app->user->id;

        $model = $this->findModel($id);
        $config = $model->config;

        if($config == null)
        {
            $config = new UserConfig();
            $config->user_id = $id;
            $config->ace_default_mode = 'text';
            $config->ace_default_theme = 'github';
        }


        return $this->render('settings', ['model' => $model, 'config' => $config]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionConfirmation()
    {
        return $this->render('confirmation');
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace app\models;


use Yii;




/**
 * This is the model class for table "tbl_user".
 *
 * @property integer $id
 * @property string $email
 * @property string $auth_key
 * @property string $password
 * @property integer $created
 * @property integer $updated
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $password_repeat;
    public $current_password;
    public $tmp_current_password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            #required
            [['email'], 'required'],
            [['password'], 'required'],
            [['current_password', 'password_repeat'], 'required', 'on' => 'change-password'],
            [['password_repeat'], 'required', 'on' => 'insert'],

            #string
            [['auth_key'], 'string'],
            [['email'], 'string', 'max' => 255],
            [['password', 'password_repeat', 'current_password'], 'string', 'max' => 32],

            #integer
            [['created', 'updated'], 'integer'],

            #email
            [['email'], 'email'],

            #unique
            [['email', 'auth_key'], 'unique'],

            #compare
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match", 'on' => ['insert', 'change-password'] ],

            #safe
            [['password_repeat', 'current_password'], 'safe'],

            #custom
            ['current_password','currentPasswordRule', 'on' => 'change-password'],
        ];
    }

    public function currentPasswordRule($attribute, $params){
        $password = $this->tmp_current_password;
        if( $password != md5($this->current_password))
            $this->addError($attribute,'current password is incorrect');
    }

    public function regenerateAuthKey()
    {
        $token = bin2hex(openssl_random_pseudo_bytes(16));

        if(!User::find()->where('auth_key = :auth_key', [':auth_key' => $token])->one()){
            $this->auth_key = $token;
            return true;
        }else{
            $this->regenerateAuthKey();
        }
    }

    public function beforeSave($insert)
    {
        if($insert) {
            $this->regenerateAuthKey();
            $this->password = md5($this->password);
            $this->created = time();
        }

        if($this->getScenario() == 'change-password') {
            $this->password = md5($this->password);
        }

        $this->updated = time();

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'created' => 'Create Date',
            'updated' => 'Update Date',
        ];
    }

    public static function findIdentity($id){
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        return static::findOne(['auth_key' => $token]);
    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){
        return $this->auth_key;
    }

    public function validateAuthKey($authKey){
        return $this->auth_key === $authKey;
    }


    public static function findByUsername($email){
        return self::findOne(['email'=>$email]);
    }

    public function validatePassword($password){
        return $this->password === md5($password);
    }

    public function getConfig()
    {
        return $this->hasOne(UserConfig::className(), ['user_id' => 'id']);
    }
}

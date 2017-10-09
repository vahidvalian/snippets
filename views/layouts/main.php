<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Snippets',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => Yii::$app->homeUrl],
                    ['label' => 'Explore', 'url' => ['/snippet/explore']],
                    ['label' => 'Sign in', 'url' => ['/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Sign up', 'url' => ['/register'], 'visible' => Yii::$app->user->isGuest],

                    ['label' => 'Add Snippet', 'url' => ['/snippet/add'], 'options' => ['class' => 'btn-success white-color'], 'visible' => !Yii::$app->user->isGuest],
                    [
                        'label' => 'Profile',
                        'items' => [
                            #TODO: email address not show!
                            '<li class="dropdown-header">'. (Yii::$app->user->isGuest) ? "" : Yii::$app->user->identity->email.'</li>',
                            ['label' => 'Settings', 'url' => ['/settings']],
                            ['label' => 'Edit Profile', 'url' => ['/user/view']],
                            ['label' => 'Change Password', 'url' => ['/change-password']],
                            ['label' => 'Sign out', 'url' => ['/logout']],
                        ],
                        'visible' => !Yii::$app->user->isGuest && isset(Yii::$app->user->identity->email)
                    ],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

            <?php if(Yii::$app->session->hasFlash('success')) { ?>
            <div class="alert alert-success">
                <strong>Success!</strong> <?=Yii::$app->session->getFlash('success')?>
            </div>
            <?php } ?>
            <?php if(Yii::$app->session->hasFlash('warning')) { ?>
                <div class="alert alert-warning">
                    <strong>Warning!</strong> <?=Yii::$app->session->getFlash('warning')?>
                </div>
            <?php } ?>
            <?php if(Yii::$app->session->hasFlash('danger')) { ?>
                <div class="alert alert-danger">
                    <strong>Error!</strong> <?=Yii::$app->session->getFlash('danger')?>
                </div>
            <?php } ?>

            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-center"><b>snippets v 1.1</b></n> is open source project<br><a href="https://github.com/vtworckman/snippets">Github</a></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

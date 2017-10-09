<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use richweber\recaptcha\Captcha;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if($model->isNewRecord) { ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?php } ?>

    <?php if($model->getScenario() == 'change-password') { ?>
    <?= $form->field($model, 'current_password')->passwordInput(['maxlength' => true]) ?>
    <?php } ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord) { ?>
        <div class="form-group"> <?= Captcha::widget() ?> </div>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

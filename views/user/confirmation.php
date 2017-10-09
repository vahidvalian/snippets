<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'User Confirmation';
$this->params['breadcrumbs'][] = ['label' => 'Registration', 'url' => ['create']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-confirmation">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Thank you for registration on snippet, your account is created and must be activated before you can use it.
        <br/>
        <div class="alert alert-info">
            To active account please check your email inbox
        </div>
    </p>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Change Password: ' . $model->email;
$this->params['breadcrumbs'][] = ['label' => "{$model->email} profile", 'url' => ['view']];
$this->params['breadcrumbs'][] = 'Change Password';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

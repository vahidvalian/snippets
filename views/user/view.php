<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = "{$model->email} profile";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Change password', ['change-password'], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'email:email',
            'auth_key:ntext',
            [
                    'attribute' => 'created',
                    'value' => function($model)
                    {
                        return date("Y-m-d H:i", $model->created);
                    }
            ],
            [
                'attribute' => 'updated',
                'value' => function($model)
                {
                    return date("Y-m-d H:i", $model->updated);
                }
            ],
        ],
    ]) ?>

    <p>
        <?= Html::a('Delete account', ['delete', 'id' => $model->id], [
            'class' => 'red-color',
            'data' => [
                'confirm' => 'Are you sure you want to delete your account?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>

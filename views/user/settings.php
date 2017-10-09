<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = ['label' => "{$model->email} profile", 'url' => ['view']];
$this->params['breadcrumbs'][] = 'Settings';

?>
<div class="user-settings">

    <h1><?= Html::encode($this->title) ?></h1>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#global" data-toggle="tab">Global</a></li>
        <li><a href="#editor" data-toggle="tab">Editor</a></li>
    </ul>
    <?php $form = ActiveForm::begin(); ?>
    <div class="tab-content clearfix">
        <div class="tab-pane active" id="global">
            <div class="row margintop25">
                <div class="col-lg-6">
                    <?= $form->field($config, 'default_language')->dropDownList(
                        ['english', 'English LTR'],
                        ['disabled' => 'disabled']
                    ) ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="editor">
            <div class="row margintop25">

                <div class="col-lg-6">
                    <?= $form->field($config, 'ace_default_mode')->dropDownList(
                        ArrayHelper::map($config->modes, 'mode','mode'),
                        ['prompt' => '-- select one --']
                    ) ?>
                </div>

                <div class="col-lg-6">
                    <?= $form->field($config, 'ace_default_theme')->dropDownList(
                        $config->themes,
                        ['prompt' => '-- select one --']
                    ) ?>
                </div>

            </div>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>

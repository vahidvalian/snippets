<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>

<div class="snippet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'pre_tags')->textInput(['maxlength' => false]) ?>

    <?= Html::label("language:" . Html::activeDropDownList($model, 'language',ArrayHelper::map(app\models\UserConfig::getModes(), 'mode','mode')), "", ['class' => 'pull-right', 'id' => 'detected_language'])?>
    
    <?=
    $form->field($model, 'code')->widget(
        'trntv\aceeditor\AceEditor',
        [
            'name' => 'aceeditor_w1',
            'mode'=> 'sh', // programing language mode. Default "html"
            'theme'=>'monokai' // editor theme. Default "github"
        ]
    )
    ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    $script = "
    function editor_setMode(mode) {
        aceeditor_w1.getSession().setMode('ace/mode/' + mode)
    }

    var changed = false;
    $('#snippet-pre_tags').on('change', function(){
       
       if(changed == false) {
             firstTag = $(this).val().split(',');
             $.ajax({
               type: 'POST',
               url: '". Url::toRoute(['snippet/check-mode']) ."',
               data: { pre_tags: firstTag[0] },
               dataType: 'json',
               success: function(data) {
                  if(data && data.mode) {
                      $('#snippet-language').val(data.mode)
                      changed = true;
                      editor_setMode(data.mode)
                  }   
               }
                  
            });
       }
    });

    $('#snippet-language').on('change', function(){
        val = $(this).val();
        editor_setMode(val)
        changed = true;
    });
    ";

    $this->registerJs($script, $this::POS_READY);
    ?>

</div>
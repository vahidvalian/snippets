<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Snippets | smart project for small code';
?>

<div class="site-index">
    <div class="text-center">
        <div>
            <img src="<?=Yii::getAlias('@web')?>/image/sc.png" id="site-logon">
            <p><b>Snippets</b></p>
        </div>
        <div class="row">
            <?php
            $form = ActiveForm::begin([
                'id' => 'index-search-form',
                'options' => ['class' => 'form-horizontal'],
                'action' => 'snippet/search',
                'method' => 'post'
            ])
            ?>
            <div class="col-md-6 col-md-offset-3">
                    <?=HTML::input('text', 'q' ,'', ['id' => 'search', 'class' => 'form-control'])?>
            </div>
                <div class="col-md-2" style="margin-left:0;padding-left:0">
                    <?=HTML::submitButton('Go!', ['class' => 'btn btn-primary pull-left'])?>
                </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
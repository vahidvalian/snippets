<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Snippet */

$this->title = 'New Snippet';
$this->params['breadcrumbs'][] = ['label' => 'Snippets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="snippet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\BaseStringHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Snippets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="snippet-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('New Snippet', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id, 'class' => "link-simulation"];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'pre_tags',
                'value' => 'tagString',
            ],
            'title',
//            [
//                'attribute' => 'code',
//                'value' => BaseStringHelper::truncate('id', 5)
//            ],
//            'description:ntext',

            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'template'=>'{view}'
            // ],
        ],
    ]); ?>

</div>

<?php
$this->registerCss("

    .link-simulation {
        cursor: pointer !important
    }

    .link-simulation:hover {
        background: #BDCBD9 !important;
    }

");
$this->registerJs("

    $('td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if(e.target == this)
            location.href = '" . Url::to(['snippet/view']) . "?id=' + id;
    });

");
<?php

use common\models\services\TheaterService;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\HallSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Halls');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hall-index">

    <h1><?=Html::encode($this->title)?></h1>

    <p>
        <?=Html::a(Yii::t('app', 'Create Hall'), ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'theater_id',
                'content' => function (\common\models\Hall $model) {
                    if (!empty($model)) {
                        return Html::encode($model->theater->name);
                    }

                    return '';
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'theater_id',
                    'data' => TheaterService::getTheaterList(),
                    'options' => ['prompt' => Yii::t('app', '')],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
            ],
            'name',
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>

</div>

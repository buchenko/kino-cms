<?php

use common\models\Seat;
use common\models\services\HallService;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SeatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Seats');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seat-index">

    <h1><?=Html::encode($this->title)?></h1>

    <p>
        <?=Html::a(Yii::t('app', 'Create Seat'), ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'hall_id',
                'content' => function (Seat $model) {
                    if (!empty($model)) {
                        $hallService = new HallService($model->hall);

                        return Html::encode($hallService->getHallDescription());
                    }

                    return '';
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'hall_id',
                    'data' => HallService::getHallList(),
                    'options' => ['prompt' => Yii::t('app', '')],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
            ],
            'row',
            'number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>

</div>

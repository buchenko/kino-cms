<?php

use common\models\services\FilmService;
use common\models\services\HallService;
use common\models\Showtime;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ShowtimeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Showtimes');
$this->params['breadcrumbs'][] = $this->title;
$ranges = [
    Yii::t('app', 'Clear') => ["''", "''"],
    Yii::t('app', 'Today') => ["moment().startOf('day')", "moment().endOf('day')"],
    Yii::t('app', 'Yesterday') => ["moment().startOf('day').subtract(1,'days')", "moment().endOf('day').subtract(1,'days')"],
    Yii::t('app', 'Last {n} Days', ['n' => 7]) => ["moment().startOf('day').subtract(6, 'days')", "moment().endOf('day')"],
    Yii::t('app', 'Last {n} Days', ['n' => 30]) => ["moment().startOf('day').subtract(29, 'days')", "moment().endOf('day')"],
    Yii::t('app', 'This Month') => ["moment().startOf('month')", "moment().endOf('month')"],
    Yii::t('app', 'Last Month') => ["moment().subtract(1, 'month').startOf('month')", "moment().subtract(1, 'month').endOf('month')"],
];
?>
<div class="showtime-index">

    <h1><?=Html::encode($this->title)?></h1>

    <p>
        <?=Html::a(Yii::t('app', 'Create Showtime'), ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'film_id',
                'content' => function (Showtime $model) {
                    if (!empty($model)) {
                        return Html::encode($model->film->name);
                    }

                    return '';
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'film_id',
                    'data' => FilmService::getFilmList(),
                    'options' => ['prompt' => Yii::t('app', '')],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
            ],
            [
                'attribute' => 'hall_id',
                'content' => function (Showtime $model) {
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
            [
                'attribute' => 'date_time',
                'filter' => '<div class="drp-container input-group">' .
                    DateRangePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'dateInterval',
                        'startAttribute' => 'startDate',
                        'endAttribute' => 'endDate',
                        'autoUpdateOnInit' => true,
                        'useWithAddon' => true,
                        'hideInput' => true,
                        'pluginOptions' => [
                            'locale' => [
                                'locale' => ['format' => 'Y-m-d'],
                            ],
                            'ranges' => $ranges,
                            'autoclose' => true,
                            'pluginEvents' => [
                                "cancel.daterangepicker" => "function() { 
                                 
                                 }",
                            ],
                            'opens' => 'right',
                        ],
                    ]) . '</div>',
                'content' => function (Showtime $model) {
                    return date('d F Y H:i', strtotime($model->date_time));
                },
                'contentOptions' => ['class' => 'small text-center text-muted'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>

</div>

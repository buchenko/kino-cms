<?php

use common\models\services\SeatService;
use common\models\services\ShowtimeService;
use common\models\services\TicketService;
use common\models\services\UserService;
use common\models\Showtime;
use common\models\Ticket;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JsExpression;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TicketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tickets');
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
<div class="ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ticket'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'showtime_id',
                'content' => function (Ticket $model) {
                    if (!empty($model)) {
                        $showtimeService = new ShowtimeService($model->showtime);

                        return Html::encode($showtimeService->getShowtimeDescription());
                    }

                    return '';
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'showtime_id',
                    'data' => ShowtimeService::getShowtimeList(),
                    'options' => ['prompt' => Yii::t('app', '')],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
            ],
            [
                'attribute' => 'seat_id',
                'content' => function (Ticket $model) {
                    if (!empty($model)) {
                        $seatService = new SeatService($model->seat);

                        return Html::encode($seatService->getSeatDescription());
                    }

                    return '';
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'seat_id',
                    'data' => SeatService::getSeatList(),
                    'options' => ['prompt' => Yii::t('app', '')],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
            ],
            [
                'attribute' => 'user_id',
                'content' => function (Ticket $model) {
                    if (!empty($model)) {
                        return Html::encode($model->user->username);
                    }

                    return '';
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'user_id',
                    'data' => UserService::getUserList(),
                    'options' => ['prompt' => Yii::t('app', '')],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
            ],
            [
                'attribute' => 'paid',
                'content' => function (Ticket $model) {
                    if (!empty($model)) {
                        $ticketService = new TicketService($model);

                        return Html::encode($ticketService->getTicketStatusDescription());
                    }

                    return '';
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'paid',
                    'hideSearch' => true,
                    'options' => ['prompt' => Yii::t('app', '')],
                    'data' =>  TicketService::getTicketStatusList(),
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
                'content' => function (Ticket $model) {
                    return date('d F Y H:i', strtotime($model->date_time));
                },
                'contentOptions' => ['class' => 'small text-center text-muted'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

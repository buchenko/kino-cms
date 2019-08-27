<?php

use common\models\services\ShowtimeService;
use common\models\services\TicketService;
use common\models\services\UserService;
use kartik\datecontrol\DateControl;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'showtime_id')->widget(Select2::class, [
        'data' => ShowtimeService::getShowtimeList(),
        'options' => [
            'id' => 'showtime_id',
        ],
        'pluginOptions' => [
            'placeholder' => '',
            'allowClear' => true,
        ],
    ])?>

    <?=$form->field($model, 'seat_id')->widget(DepDrop::class, [
        'options' => [
            'id' => 'seat_id',
        ],
        'pluginOptions' => [
            'depends' => ['showtime_id'],
            'placeholder' => 'Select...',
            'url' => Url::to(['/seat/seats-hall']),
        ],
    ])?>

    <?=$form->field($model, 'user_id')->widget(Select2::class, [
        'data' => UserService::getUserList(),
        'pluginOptions' => [
            'placeholder' => '',
            'allowClear' => true,
        ],
    ])?>

    <?=$form->field($model, 'paid')->widget(Select2::class, [
        'data' => TicketService::getTicketStatusList(),
        'pluginOptions' => [
            'placeholder' => '',
            'allowClear' => true,
        ],
    ])?>

    <?=$form->field($model, 'date_time')->widget(DateControl::class, [
        'displayFormat' => 'php:d F Y H:i',
        'type' => DateControl::FORMAT_DATETIME,
        'readonly' => true,
        'widgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true,
                'todayHighlight' => true,
                'weekStart' => '1',
            ],
        ],
        'saveFormat' => 'php:Y-m-d H:i:s',
    ])?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

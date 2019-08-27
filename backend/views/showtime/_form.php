<?php

use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use kartik\widgets\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\services\FilmService;
use common\models\services\HallService;

/* @var $this yii\web\View */
/* @var $model common\models\Showtime */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="showtime-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'film_id')->widget(Select2::class, [
        'data' => FilmService::getFilmList(),
        'pluginOptions' => [
            'placeholder' => '',
            'allowClear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'hall_id')->widget(Select2::class, [
        'data' => HallService::getHallList(),
        'pluginOptions' => [
            'placeholder' => '',
            'allowClear' => true,
        ],
    ]) ?>

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
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

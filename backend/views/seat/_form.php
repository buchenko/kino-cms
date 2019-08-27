<?php

use common\models\services\HallService;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Seat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hall_id')->widget(Select2::class, [
        'data' => HallService::getHallList(),
        'pluginOptions' => [
            'placeholder' => '',
            'allowClear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'row')->textInput() ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

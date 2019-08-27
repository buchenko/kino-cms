<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use \common\models\services\TheaterService;

/* @var $this yii\web\View */
/* @var $model common\models\Hall */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="hall-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'theater_id')->widget(Select2::class, [
        'data' => TheaterService::getTheaterList(),
        'pluginOptions' => [
            'placeholder' => '',
            'allowClear' => true,
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

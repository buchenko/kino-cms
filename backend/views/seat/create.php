<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Seat */

$this->title = Yii::t('app', 'Create Seat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Showtime */

$this->title = Yii::t('app', 'Create Showtime');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Showtimes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="showtime-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

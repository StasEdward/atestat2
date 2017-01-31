<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SETSTATIONSLIST */

$this->title = 'Update Setstationslist: ' . $model->stationid;
$this->params['breadcrumbs'][] = ['label' => 'Setstationslists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->stationid, 'url' => ['view', 'stationid' => $model->stationid, 'devicename' => $model->devicename]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="setstationslist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\SETSTATIONSLIST;
use app\models\SETSTATIONSLISTSearch;

/* @var $this yii\web\View */
/* @var $model app\models\SETSTATIONSLIST */

$this->title = $model->stationid;
$this->params['breadcrumbs'][] = ['label' => 'Setstationslists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setstationslist-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'stationid' => $model->stationid, 'devicename' => $model->devicename], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'stationid' => $model->stationid, 'devicename' => $model->devicename], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'stationid',
            'devicename',
            'devicetype',
            'interface',
            'addr',
            'order_id',
            'devpic',
            'test_function_name',
            'dllname',
        ],
    ]) ?>

</div>

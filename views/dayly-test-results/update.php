<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DaylyTestResults */

$this->title = 'Update Dayly Test Results: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dayly Test Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dayly-test-results-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TracesList */

$this->title = 'Update Traces List: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Traces Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="traces-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

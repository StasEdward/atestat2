<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Atereport */

$this->title = 'Update Atereport: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Atereports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atereport-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

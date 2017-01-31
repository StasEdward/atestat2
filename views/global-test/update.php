<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GlobalTest */

$this->title = 'Update Global Test: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Global Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="global-test-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

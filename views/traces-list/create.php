<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TracesList */

$this->title = 'Create Traces List';
$this->params['breadcrumbs'][] = ['label' => 'Traces Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traces-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

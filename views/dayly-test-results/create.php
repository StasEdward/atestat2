<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DaylyTestResults */

$this->title = 'Create Dayly Test Results';
$this->params['breadcrumbs'][] = ['label' => 'Dayly Test Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dayly-test-results-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

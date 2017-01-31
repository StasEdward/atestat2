<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FacilityList */

$this->title = 'Update Facility List: ' . $model->facility_name;
$this->params['breadcrumbs'][] = ['label' => 'Facility Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->facility_name, 'url' => ['view', 'id' => $model->facility_name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="facility-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

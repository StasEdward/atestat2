<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FacilityList */

$this->title = 'Create Facility List';
$this->params['breadcrumbs'][] = ['label' => 'Facility Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facility-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

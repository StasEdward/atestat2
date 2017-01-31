<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Atereport */

$this->title = 'Create Atereport';
$this->params['breadcrumbs'][] = ['label' => 'Atereports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atereport-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

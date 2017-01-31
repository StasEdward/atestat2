<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ROUTINGCONFIG */

$this->title = 'Create Routingconfig';
$this->params['breadcrumbs'][] = ['label' => 'Routingconfigs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="routingconfig-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

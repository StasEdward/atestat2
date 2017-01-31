<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GlobalTest */

$this->title = 'Create Global Test';
$this->params['breadcrumbs'][] = ['label' => 'Global Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="global-test-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

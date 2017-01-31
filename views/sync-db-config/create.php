<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\syncdbconfig */

$this->title = 'Create Syncdbconfig';
$this->params['breadcrumbs'][] = ['label' => 'Syncdbconfigs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="syncdbconfig-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

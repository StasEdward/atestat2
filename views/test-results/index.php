<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestResultsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test Results';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-results-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Test Results', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->ID), ['view', 'id' => $model->ID]);
        },
    ]) ?>
<?php Pjax::end(); ?></div>

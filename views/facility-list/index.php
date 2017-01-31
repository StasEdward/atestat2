<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FacilityListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Facility Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facility-list-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Facility List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'facility_name',
            'external_ip',
            'internal_ip',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>


<div class="row">
  <div class="col-6 col-md-4">
      <h2 style='text-align:center'>Venture</h2>
      <img src="http://mrtg/graphimg.png?id=542">
  </div>
  <div class="col-6 col-md-4">
      <h2  style='text-align:center'>Indya</h2>
      <img src="http://mrtg/graphimg.png?id=480">
  </div>
  <div class="col-6 col-md-4">
      <h2  style='text-align:center'>Flex</h2>
      <img src="http://mrtg/graphimg.png?id=243">
  </div>
</div>

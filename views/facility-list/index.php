<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FacilityListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Facility Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facility-list-index">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-success">
                <div class="box box-solid ">
                    <div class="box-header with-border">
                        <i class="fa fa-picture-o"></i>
                        <h3 class="box-title">Facility Lists</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body border-radius-none">
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
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="box box-success">
                    <div class="box box-solid ">
                        <div class="box-header with-border">
                            <i class="fa fa-picture-o"></i>
                            <h3 class="box-title">Venture</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body border-radius-none">
                            <img class="img-responsive" src="/images/542.png">
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-6 col-md-4">
                <div class="box box-success">
                    <div class="box box-solid ">
                        <div class="box-header with-border">
                            <i class="fa fa-picture-o"></i>
                            <h3 class="box-title">Venture</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body border-radius-none">
                            <img class="img-responsive" src="/images/542.png">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="box box-success">
                    <div class="box box-solid ">
                        <div class="box-header with-border">
                            <i class="fa fa-picture-o"></i>
                            <h3 class="box-title">India</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body border-radius-none">
                            <img class="img-responsive" src="/images/480.png">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="box box-success">
                    <div class="box box-solid ">
                        <div class="box-header with-border">
                            <i class="fa fa-picture-o"></i>
                            <h3 class="box-title">Flex</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body border-radius-none">
                            <img class="img-responsive" src="/images/243.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

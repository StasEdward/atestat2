<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\themes\adminLTE\components\ThemeNav;
use kartik\widgets\SideNav;
use yii\helpers\Url;
/*
if(!Yii::$app->user->isGuest){
echo Yii::$app->user->identity->username;
echo "<br>";
print_r(Yii::$app->user->identity);

}
*/
?>



<?php $this->beginContent('@app/themes/adminLTE/layouts/main.php'); ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/user_accounts.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>
                    <?php
                    $info[] = Yii::t('app','Hello');

                    if(isset(Yii::$app->user->identity->username))
                    $info[] = ucfirst(\Yii::$app->user->identity->username);

                    echo implode(', ', $info);

                    ?>
                </p>
                <?php if(isset(Yii::$app->user->identity->username))
                echo "<a><i class='fa fa-circle text-success'></i> Online</a>";
                else
                echo "<a><i class='fa fa-circle text-danger'></i> Offline</a>";
                ?>
            </div>
            <div class="pull-left image">
                <!-- search form -->
                <form action="/global-test/index?" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="GlobalTestSearch[SERIALNUMBER]" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->
            </div>

        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php

        //print_r($this);
        $left_menuItems = [
            ['label'=>Yii::t('app','MAIN NAVIGITION'), 'options'=>['class'=>'header']],
            ['label' => ThemeNav::link('Dashboard', 'fa fa-dashboard'), 'url' => ['/site/index'], 'visible'=>!Yii::$app->user->isGuest],
            ['label' => ThemeNav::link('Tests Results', 'fa fa-desktop'), 'url' => ['#'], 'visible'=>!Yii::$app->user->isGuest, 'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>', 'items' => [
                    ['label' => ThemeNav::link('Global Tests', 'fa fa-list-alt'), 'url' => ['/global-test/index'], 'visible'=>!Yii::$app->user->isGuest],
                    ['label' => ThemeNav::link('ATE report', 'fa fa-table'), 'url' => ['/atereport/index'], 'visible'=>!Yii::$app->user->isGuest],
                    ],
                ],
            ];


        if(!Yii::$app->user->isGuest){
            if ((Yii::$app->user->identity->getIsAdmin()) OR (\Yii::$app->user->identity->username == 'Ceragon')) {
                array_push($left_menuItems,  ['label' => ThemeNav::link('ATE Tools', 'fa fa-wrench'), 'url' => ['#'], 'visible'=>!Yii::$app->user->isGuest, 'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>', 'items' => [
                        ['label' => ThemeNav::link('Station config', 'fa fa-gears'), 'url' => ['/setstationlist/index'], 'visible'=>!Yii::$app->user->isGuest],
                        ['label' => ThemeNav::link('Sample Routing config', 'fa fa-code-fork'), 'url' => ['/routing-config/index'], 'visible'=>!Yii::$app->user->isGuest],
                        ['label' => ThemeNav::link('Facility List', 'fa fa-sitemap'), 'url' => ['/facility-list/index'], 'visible'=>!Yii::$app->user->isGuest],
                        ['label' => ThemeNav::link('ATE config', 'fa fa-list-alt'), 'url' => ['/index'], 'visible'=>!Yii::$app->user->isGuest],
                    ],
            ]);

            };
            if (Yii::$app->user->identity->getIsAdmin()){
                array_push($left_menuItems,  ['label' => ThemeNav::link('Manage users', 'fa fa-users'), 'url' => ['user/admin/index'], 'visible'=>Yii::$app->user->identity->getIsAdmin()]);
                array_push($left_menuItems,  ['label' => ThemeNav::link('Server Status', 'fa fa-database'), 'url' => ['/server/index'], 'visible'=>Yii::$app->user->identity->getIsAdmin()]);
                array_push($left_menuItems,  ['label' => ThemeNav::link('Gii',  'fa fa-file-code-o'), 'url' => ['/gii'], 'visible'=>Yii::$app->user->identity->getIsAdmin()]);
                array_push($left_menuItems,  ['label' => ThemeNav::link('Debug', 'fa fa-bug'), 'url' => ['/debug'], 'visible'=>Yii::$app->user->identity->getIsAdmin()]);
            };
        };
        echo Menu::widget([
            'encodeLabels'=>false,
            'options' => [
                'class' => 'sidebar-menu treeview'
            ],
            'items' => $left_menuItems,
            'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
            'encodeLabels' => false, //allows you to use html in labels
            'activateParents' => true,
            'activateItems' => true,
        ]); ?>

    </section>
    <!-- /.sidebar -->


<?php
/*
$type = SideNav::TYPE_INFO;
$item = '';
echo SideNav::widget([
    'type' => $type,
    'encodeLabels' => false,
  //  'heading' => $heading,
 'headingOptions' => ['class'=>'head-style'],
    'items' => [
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default action is used.
        ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => Url::to(['/site/index', 'type'=>$type]), 'active' => ($item == 'home')],
        ['label' => 'Test results', 'icon' => 'list', 'items' => [
            ['label' => '<span class="pull-right badge">10</span> Global Tests', 'url' => Url::to(['/global-test/index', 'type'=>$type]), 'active' => ($item == 'new-arrivals')],
            ['label' => '<span class="pull-right badge">5</span> Most Popular', 'url' => Url::to(['/site/most-popular', 'type'=>$type]), 'active' => ($item == 'most-popular')],
            ['label' => 'Read Online', 'icon' => 'cloud', 'items' => [
                ['label' => 'Online 1', 'url' => Url::to(['/site/online-1', 'type'=>$type]), 'active' => ($item == 'online-1')],
                ['label' => 'Online 2', 'url' => Url::to(['/site/online-2', 'type'=>$type]), 'active' => ($item == 'online-2')]
            ]],
        ]],
        ['label' => '<span class="pull-right badge">3</span> Categories', 'icon' => 'tags', 'items' => [
            ['label' => 'Fiction', 'url' => Url::to(['/site/fiction', 'type'=>$type]), 'active' => ($item == 'fiction')],
            ['label' => 'Historical', 'url' => Url::to(['/site/historical', 'type'=>$type]), 'active' => ($item == 'historical')],
            ['label' => '<span class="pull-right badge">2</span> Announcements', 'icon' => 'bullhorn', 'items' => [
                ['label' => 'Event 1', 'url' => Url::to(['/site/event-1', 'type'=>$type]), 'active' => ($item == 'event-1')],
                ['label' => 'Event 2', 'url' => Url::to(['/site/event-2', 'type'=>$type]), 'active' => ($item == 'event-2')]
            ]],
        ]],
        ['label' => 'Profile', 'icon' => 'user', 'url' => Url::to(['/site/profile', 'type'=>$type]), 'active' => ($item == 'profile')],
    ],
]);
*/
?>

</aside>

<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo Html::encode($this->title); ?> </h1>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php echo $content; ?>
        </section><!-- /.content -->

    </div><!-- /.right-side -->
    <?php $this->endContent();

<?php

namespace app\themes\adminLTE\assets;

use yii\web\AssetBundle;

class AdminlteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';
    public $css = [
      //  'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
      //  'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
    //    'css/font-awesome.min.css',
    //    'css/ionicons.min.css',
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css',
    ];
    public $js = [
        'js/app.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
        '\rmrevin\yii\ionicon\AssetBundle',
    ];
}

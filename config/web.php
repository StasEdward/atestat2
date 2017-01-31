<?php
ini_set('memory_limit', '512M');
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout'=>'column2',
    'layoutPath'=>'@app/themes/adminLTE/layouts',

//    'sourceLanguage'=>'en',
 //   'language' => 'en',
    'modules'=>[
        'dynagrid'=> [
            'class'=>'\kartik\dynagrid\Module',
        // other module settings
        ],
        'gridview'=> [
            'class'=>'\kartik\grid\Module',
        // other module settings
        ],
        'user' => [
                'class' => 'dektrium\user\Module',
                'enableUnconfirmedLogin' => false,
                'confirmWithin' => 21600,
                'cost' => 12,
//                'rememberFor ' => 1209600,
                'admins' => ['admin'],
            ],

/*

        'user' => [
          'class' => 'dektrium\user\Module',

          'enableUnconfirmedLogin' => false,
          'enableRegistration' => false,
          'confirmWithin' => 21600,
          'cost' => 12,
          'admins' => ['admin']
        ],
*/

    ],


    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '24Wt3yrdOJwcnEabRxu8wnf5JwA2lVFO',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    //    'user' => [
  //        'identityClass' => 'app\models\User',
  //        'enableAutoLogin' => true,
  //      ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'db_atemain' => require(__DIR__ . '/db_atemain.php'),
        //'db_flex2' => require(__DIR__ . '/db_flex2.php'),
        //'db_ionics1' => require(__DIR__ . '/db_ionics1.php'),
        //'db_ionics2' => require(__DIR__ . '/db_ionics2.php'),
        //'db_vcl1' => require(__DIR__ . '/db_vcl1.php'),
        //'db_vcl1' => require(__DIR__ . '/firebird.php'),

      //  *
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                            ''=>'site/index',
                            '<action:(index|login|logout)>'=>'site/<action>',
                            '<controller:\w+>/<id:\d+>' => '<controller>/view',
                            '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                            '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
            ],
        ],
        'view' => [
                    'theme' => [
                        'pathMap' => [
                          '@dektrium/user/views' => '@app/views/user',
                          '@app/views' => '@app/themes/adminLTE',
                        ],
                        'baseUrl' => '@web/../themes/adminLTE',

                    ],
                ],

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                   // 'sourceLanguage' => 'en',
                    'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@fileinput/messages',
                ],
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [ //here
                'crud' => [ // generator name
                    'class' => 'yii\gii\generators\crud\Generator', // generator class
                    'templates' => [ //setting for out templates
                        'custom' => '@app/vendor/yiisoft/yii2-gii/generators/crud/custom', // template name => path to template
                    ]
                ]
            ],
        'allowedIPs' => ['*'],
    ];
}

return $config;

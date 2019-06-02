<<<<<<< HEAD
<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-edulab',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log',
      'common\config\settings',
      'forum',
    ],
    //'language' => 'id-ID',
    'controllerNamespace' => 'edulab\controllers',
        'modules' => [
          //  'user' => [
        //'class' => 'dektrium\user\Module',
    //],
                'notifications' => [
            'class' => 'machour\yii2\notifications\NotificationsModule',
            // Point this to your own Notification class
            // See the "Declaring your notifications" section below
            'notificationClass' => 'common\models\Notification',
            // Allow to have notification with same (user_id, key, key_id)
            // Default to FALSE
            'allowDuplicate' => false,
            // This callable should return your logged in user Id
            'userId' => function() {
                return \Yii::$app->user->id;
            }
        ],
   'gridview' =>  [
        'class' => '\kartik\grid\Module'
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
        // 'downloadAction' => 'gridview/export/download',
        // 'i18n' => []
    ],
            'social' => [
        // the module class
        'class' => 'kartik\social\Module',
 
        // the global settings for the Disqus widget
        'facebook' => [
            'appId' => '160460681089600',
            'secret' => '8f7424005804ec71d28aa8f6b9bed95d',
        ],

 
 ],
        'edulab' => [
            'class' => 'app\modules\edulab\Edulab',
            // ... other configurations for the module ...
        ],
        'core' => [
            'class' => 'common\modules\core\Core',
        ],

    'forum' => [
        'class' => 'bizley\podium\Podium',
        'userComponent' => 'user',
        'adminId' => 3,
        'allowedIPs' => ['*'],
    ],



    ],
    'components' => [
            'assetManager' => [
            //'linkAssets' => true,
                'bundles' => [
        'yii2mod\alert\AlertAsset' => [
            'css' => [
                'dist/sweetalert.css',
                'themes/twitter/twitter.css',
            ]
        ],
    ],
        ],
            'view' => [
            'theme' => [
                'basePath' => '@app/themes/edulab',
                'baseUrl' => '@web/themes/edulab',
                'pathMap' => [
                    '@app/views' => '@app/themes/edulab',
                ],
            ],
        ],

  /*      'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'pao-frontend',
                    'cookieParams' => [
            'path' => '/',
            'domain' => "localhost",
        ],
        ],
        
*/

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'urlManager' => [
         'enablePrettyUrl' => true,
         'showScriptName' => true,
         'enableStrictParsing' => false,
            'rules' => [
           '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],

    'i18n' => [
        'translations' => [
            'app*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                //'basePath' => '@app/messages',
                //'sourceLanguage' => 'en-US',
                'fileMap' => [
                    'app' => 'app.php',
                   // 'app/error' => 'error.php',
                ],
            ],
        ],
    ],
    ],
    'params' => $params,
];
=======
<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-edulab',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log',
      'common\config\settings',
      'forum',
    ],
    //'language' => 'id-ID',
    'controllerNamespace' => 'edulab\controllers',
        'modules' => [
          //  'user' => [
        //'class' => 'dektrium\user\Module',
    //],
                'notifications' => [
            'class' => 'machour\yii2\notifications\NotificationsModule',
            // Point this to your own Notification class
            // See the "Declaring your notifications" section below
            'notificationClass' => 'common\models\Notification',
            // Allow to have notification with same (user_id, key, key_id)
            // Default to FALSE
            'allowDuplicate' => false,
            // This callable should return your logged in user Id
            'userId' => function() {
                return \Yii::$app->user->id;
            }
        ],
   'gridview' =>  [
        'class' => '\kartik\grid\Module'
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
        // 'downloadAction' => 'gridview/export/download',
        // 'i18n' => []
    ],
            'social' => [
        // the module class
        'class' => 'kartik\social\Module',
 
        // the global settings for the Disqus widget
        'facebook' => [
            'appId' => '160460681089600',
            'secret' => '8f7424005804ec71d28aa8f6b9bed95d',
        ],

 
 ],
        'edulab' => [
            'class' => 'app\modules\edulab\Edulab',
            // ... other configurations for the module ...
        ],
        'core' => [
            'class' => 'common\modules\core\Core',
        ],

    'forum' => [
        'class' => 'bizley\podium\Podium',
        'userComponent' => 'user',
        'adminId' => 3,
        'allowedIPs' => ['*'],
    ],



    ],
    'components' => [
            'assetManager' => [
            //'linkAssets' => true,
                'bundles' => [
        'yii2mod\alert\AlertAsset' => [
            'css' => [
                'dist/sweetalert.css',
                'themes/twitter/twitter.css',
            ]
        ],
    ],
        ],
            'view' => [
            'theme' => [
                'basePath' => '@app/themes/edulab',
                'baseUrl' => '@web/themes/edulab',
                'pathMap' => [
                    '@app/views' => '@app/themes/edulab',
                ],
            ],
        ],

  /*      'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'pao-frontend',
                    'cookieParams' => [
            'path' => '/',
            'domain' => "localhost",
        ],
        ],
        
*/

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'urlManager' => [
         'enablePrettyUrl' => true,
         'showScriptName' => true,
         'enableStrictParsing' => false,
            'rules' => [
           '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],

    'i18n' => [
        'translations' => [
            'app*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                //'basePath' => '@app/messages',
                //'sourceLanguage' => 'en-US',
                'fileMap' => [
                    'app' => 'app.php',
                   // 'app/error' => 'error.php',
                ],
            ],
        ],
    ],
    ],
    'params' => $params,
];
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605

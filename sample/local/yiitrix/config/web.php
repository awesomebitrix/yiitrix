<?php

$params = require(__DIR__ . '/params.php');


$config = [
    'id' => 'basic',
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
    'basePath' => __DIR__ . '../',
    'bootstrap' => ['log'],
    'components' => [
        'assetManager' => [
            'basePath' => '@app/assets'
        ],

        'response' => [
            'class' => 'BitrixResponse',
        ],

        'request' => [
            'cookieValidationKey' => '',
            'enableCsrfValidation' => false,
        ],

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'app' => 'app.php'
                    ],
                ],
            ],
        ],

        'formatter' => [
            'sizeFormatBase' => 1000
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '/',
            'rules' => [
                '' => 'pages/front',

                'new' => 'catalog/form',


                'catalog/<code:[\w-]+>' => 'catalog/section',
                'catalog/<code:[\w-]+>/<id:[\w-]+>' => 'catalog/detail',

                '<code:[\w-]+>' => 'pages/common-page',

                '<controller>/<action>' => '<controller>/<action>',
            ],
        ],

        'user' => [
            'identityClass' => 'app\models\User',
        ],

        'errorHandler' => [
            'class' => 'BitrixErrorHandler',
            'discardExistingOutput' => false,
            'errorAction' => 'site/error',
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logVars' => [],
                ],
            ],
        ],
        //'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    /*$config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];*/

    /*$config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];*/
}

return $config;

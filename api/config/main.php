<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [        
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
        ],
        'bootstrap' => [
            'class'=> 'common\components\Bootstrap',
        ],
        'mail' => [
         'class' => 'yii\swiftmailer\Mailer',
         'useFileTransport' => false,
         'transport' => [
         'class' => 'Swift_SmtpTransport',
         'host' => 'smtp.gmail.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
             'username' => 'thenorwaycleaner@gmail.com',
             'password' => 'nqlszkzohgiunubo',
             'port' => '587', // Port 25 is a very common port too
             'encryption' => 'tls', 
             ],
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => ['v1/user','v1/cleaner-category','v1/category','v1/cleaner-region','v1/subscription','v1/region','v1/job','v1/ad-place','v1/cleaner','v1/rating','v1/ad-pool','v1/advertisment'],
                    

                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ]
                    
                ],
                  
                              [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/job'],
                    'pluralize' => false,
                    'extraPatterns' => [
                      'GET customer-jobs' => 'customer-jobs', 
                    'OPTIONS customer-jobs' => 'options',
                     'GET cleaner-jobs' => 'cleaner-jobs', 
                    'OPTIONS cleaner-jobs' => 'options',
                       'GET cleaner-preferred-jobs' => 'cleaner-preferred-jobs', 
                    'OPTIONS cleaner-preferred-jobs' => 'options'

                      // 'xxxxx' refers to 'actionXxxxx'
                    ],
                ],

                                   [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/cleaner'],
                    'pluralize' => false,
                    'extraPatterns' => [
                      'GET view-profile' => 'view-profile', 
                    'OPTIONS view-profile' => 'options',
                  
                  

                      // 'xxxxx' refers to 'actionXxxxx'
                    ],
                ], 
   
                                   [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/upload'],
                    'pluralize' => false,
                    'extraPatterns' => [
                      'POST upload' => 'upload', 
                    'OPTIONS upload' => 'options',
                  
                  

                      // 'xxxxx' refers to 'actionXxxxx'
                    ],
                ],

                  [
                    'class'=>'yii\rest\UrlRule',
                    'controller'=>[
                        'v1/upload',
                    ],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'POST multi-upload' => 'multi-upload',
                        'OPTIONS multi-upload' => 'options',
           ]
            ],
              
                [
                    'class'=>'yii\rest\UrlRule',
                    'controller'=>[
                        'v1/rating',
                    ],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'GET notification' => 'notification',
                        'OPTIONS notification' => 'options',
        ]
    ],

    [
                    'class'=>'yii\rest\UrlRule',
                    'controller'=>[
                        'v1/user',
                    ],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'GET get-cleaner' => 'get-cleaner',
                        'OPTIONS get-cleaner' => 'options',
        ]
    ],



             [
                      'class'=>'yii\rest\UrlRule',
                    'controller'=>[
                        'v1/ad-pool',
                    ],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'GET show-ads' => 'show-ads',
                        'OPTIONS show-ads' => 'options',
                   ]
             ],

    [
                    'class'=>'yii\rest\UrlRule',
                    'controller'=>[
                        'v1/ad-pool',
                    ],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'GET view-all-ads' => 'view-all-ads',
                        'OPTIONS view-all-ads' => 'options',
        ]
    ],


                 [
                    'class'=>'yii\rest\UrlRule',
                    'controller'=>[
                        'v1/ad-pool',
                    ],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'PUT update-ads' => 'update-ads',
                        'OPTIONS update-ads' => 'options',
                     ]
                   ],

    [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/user'],
                    'pluralize' => false,
                    'extraPatterns' => [
                    'POST signup' => 'signup',
                    'OPTIONS signup' => 'options',
                    'GET activate-account' => 'activate-account',
                    'OPTIONS activate-account' => 'options',
                     'POST login' => 'login',
                    'OPTIONS login' => 'options'

                     // 'xxxxx' refers to 'actionXxxxx'
                    ],
                ],

            ],        
        ]
    ],
    'params' => $params,
];




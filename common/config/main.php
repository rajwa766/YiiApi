<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'stripe' => [
            'class' => 'ruskid\stripe\Stripe',
            'publicKey' => "pk_test_BQokikJOvBiI2HlWgH4olfQ2",
            'privateKey' => "sk_test_BQokikJOvBiI2HlWgH4olfQ2",
        ],

    ],
];

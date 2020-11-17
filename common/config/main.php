<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authClientCollection' => [
                'class' => 'yii\authclient\Collection',
                'clients' => [
                    'google' => [
                        'class' => 'yii\authclient\clients\GoogleOAuth',
                        'clientId' => '403248810587-qv5s3td09j82objs8fttv4mikarpec84.apps.googleusercontent.com',
                        'clientSecret' => 'P6zBrzelVNgKOMGJPvaspAoa',
                    ],
                ],
            ],        
    ],
];

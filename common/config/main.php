<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'America/Los_Angeles',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],      
    ],
];

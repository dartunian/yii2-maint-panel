<?php
return [
    'name' => 'DavisHou.se',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'America/Los_Angeles',
    'modules' => [
        'gridview' => ['class' => 'kartik\grid\Module']
    ],    
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],      
    ],
];

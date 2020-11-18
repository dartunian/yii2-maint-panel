<?php
$config = parse_ini_file('/var/secure/hello.ini', true);
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
                        'class' => 'yii\authclient\clients\Google',
                        'clientId' => $config['oauth_google_clientId'],
                        'clientSecret' => $config['oauth_google_clientSecret'],
                    ],
                ],
            ],        
    ],
];

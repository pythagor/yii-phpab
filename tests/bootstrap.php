<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../vendor/yiisoft/yii/framework/yiit.php');
$config = [
    'basePath'   => __DIR__,
    'components' => [
        'YiiPhpab' => [
            'class' => 'pythagor\yiiphpab\YiiPhpab',
        ],
    ],
];

Yii::createWebApplication($config);

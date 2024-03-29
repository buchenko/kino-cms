<?php
/**
 * This file is generated by the "yii asset" command.
 * DO NOT MODIFY THIS FILE DIRECTLY.
 * @version 2019-08-27 12:38:15
 */
return [
    'all' => [
        'class' => 'yii\\web\\AssetBundle',
        'basePath' => '@webroot',
        'baseUrl' => '@web',
        'js' => [
            'js/all-1.js',
        ],
        'css' => [
            'css/all-1.css',
        ],
        'sourcePath' => null,
        'depends' => [],
    ],
    'yii\\web\\JqueryAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'yii\\web\\YiiAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'yii\\web\\JqueryAsset',
            'all',
        ],
    ],
    'yii\\bootstrap\\BootstrapAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'backend\\assets\\AppAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'yii\\web\\YiiAsset',
            'yii\\bootstrap\\BootstrapAsset',
            'all',
        ],
    ],
];
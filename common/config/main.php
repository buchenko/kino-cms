<?php

use kartik\datecontrol\Module;

return [
    'name' => 'kino-cms',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => [
        'log',
    ],
    'modules' => [
        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd.MM.yyyy',
                Module::FORMAT_TIME => 'HH:mm',
                Module::FORMAT_DATETIME => 'dd.MM.yyyy HH:mm',
            ],

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d',
                Module::FORMAT_TIME => 'php:H:i',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i',
            ],

            // set your display timezone
            'displayTimezone' => 'Europe/Kiev',

            // set your timezone for date saved to db
            'saveTimezone' => 'Europe/Kiev',

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => ['type' => 2, 'pluginOptions' => ['autoclose' => true]], // example
                Module::FORMAT_DATETIME => [], // setup if needed
                Module::FORMAT_TIME => [], // setup if needed
            ],

            // custom widget settings that will be used to render the date input instead of kartik\widgets,
            // this will be used when autoWidget is set to false at module or widget level.
            'widgetSettings' => [
                Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker', // example
                    'options' => [
                        'dateFormat' => 'php:d-M-Y',
                        'options' => ['class' => 'form-control'],
                    ],
                ],
            ]
        ],
    ],
    'components' => [
        'formatter' => [
            //'locale' => 'uk-UA',
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'dd-MM-yyyy',
            'datetimeFormat' => 'dd-MM-yyyy HH:mm',
            'timeFormat' => 'HH:mm',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'nullDisplay' => Yii::t('app', 'Не визначено'),
            'currencyCode' => 'UAH',
            'numberFormatterOptions' => [
                NumberFormatter::MIN_FRACTION_DIGITS => 0,
                NumberFormatter::MAX_FRACTION_DIGITS => 3,
            ],
            //'numberFormatterSymbols' => [
            //    NumberFormatter::CURRENCY_SYMBOL => '₴',
            //],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];

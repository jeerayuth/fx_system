<?php
use kartik\datecontrol\Module;
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'th',
    'timezone'=>'Asia/Bangkok',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        
       'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',

           // 'language'=> 'th',

            // format settings for displaying each date attribute
            'displaySettings' => [
                'date' => 'd MMMM yyyy',
                'time' => 'hh:mm:ss',
                'datetime' => 'dd MMMM yyyy hh:mm:ss',
            ],

//            'displaySettings' => [
//                'date' => 'php:d-M-Y',
//                'time' => 'php:H:i:s',
//                'datetime' => 'php:d-M-Y H:i:s'
//            ],

            // format settings for saving each date attribute
            'saveSettings' => [
                'date' => 'php:Y-m-d',
                'time' => 'php:H:i:s',
                'datetime' => 'php:Y-m-d H:i:s',
            ],
           
  
            // set your display timezone
            'displayTimezone' => 'Asia/Bangkok',

            // set your timezone for date saved to db
            'saveTimezone' => 'Asia/Bangkok',
            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

            'autoWidgetSettings' => [
                Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // example
                Module::FORMAT_DATETIME => [], // setup if needed
                Module::FORMAT_TIME => [], // setup if needed
            ],

        ],
        
        
        
    ],
];

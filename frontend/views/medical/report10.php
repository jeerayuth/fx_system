<?php

/* @var $this yii\web\View */
use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>

<?php


    
    if($type_id == 1) {
        $return_date_name = 'วันครบกำหนดคืน';
    } else if ($type_id == 2) {
        $return_date_name = 'วันที่คืน';
    }
?>

<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'heading' => $report_name,
        'before' => '',
        'type' => 'primary',
        'after' => 'ประมวลผล ณ วันที่ ' . date('Y-m-d H:i:s')
    ],
    'export' => [
        'fontAwesome' => true,
        'showConfirmAlert' => false,
        'target' => GridView::TARGET_BLANK
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'an',
            'header' => 'AN'
        ],
         [
            'attribute' => 'hn',
            'header' => 'HN'
        ],
        [
            'attribute' => 'rent_user',
            'header' => 'login ผู้ยืม'
        ],
        [
            'attribute' => 'user_fullname',
            'header' => 'ชื่อผู้ยืม'
        ],
         [
            'attribute' => 'rent_date',
            'header' => 'วันที่ยืม'
        ],
        [
            'attribute' => 'return_date',
            'header' => $return_date_name
        ],
                   
          
    ]
])
?>


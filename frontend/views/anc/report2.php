<?php

/* @var $this yii\web\View */

use kartik\grid\GridView;
use yii\helpers\Html;
//use miloschuman\highcharts\Highcharts;

$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>


<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'heading' => $report_name,
        'before' => $details,
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
            'attribute' => 'hn',
            'header' => 'HN'
        ],
        [
            'attribute' => 'pt_name',
            'header' => 'ชื่อ-สกุล'
        ],
         [
            'attribute' => 'age_y',
            'header' => 'อายุ (ปี)'
        ],
         [
            'attribute' => 'pdx',
            'header' => 'รหัสวินิจฉัยหลัก'
        ],
        [
            'attribute' => 'vstdate',
            'header' => 'วันที่รับบริการ'
        ],  
        [
            'attribute' => 'lab_items_name',
            'header' => 'ชื่อแลป'
        ], 
         [
            'attribute' => 'lab_order_result',
            'header' => 'ผลแลป'
        ], 
          
    ]
])
?>


<?php

/* @var $this yii\web\View */

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

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
            'attribute' => 'vstdate',
            'header' => 'วันที่รับบริการ'
        ],
        [
            'attribute' => 'vn',
            'header' => 'VN'
        ],
         [
            'attribute' => 'hn',
            'header' => 'HN'
        ],
        [
            'attribute' => 'pt_name',
            'header' => 'ชื่อ-สกุล'
        ],
         [
            'attribute' => 'pdx',
            'header' => 'รหัสวินิจฉัยหลัก'
        ],
         [
            'attribute' => 'dx0',
            'header' => 'รหัสวินิจฉัยรอง 1'
        ],
         [
            'attribute' => 'dx1',
            'header' => 'รหัสวินิจฉัยรอง 2'
        ],
         [
            'attribute' => 'dx2',
            'header' => 'รหัสวินิจฉัยรอง 3'
        ],
        [
            'attribute' => 'dx3',
            'header' => 'รหัสวินิจฉัยรอง 4'
        ],
         [
            'attribute' => 'dx4',
            'header' => 'รหัสวินิจฉัยรอง 5'
        ],
        [
            'attribute' => 'dx5',
            'header' => 'รหัสวินิจฉัยรอง 6'
        ],
        [
            'attribute' => 'bw',
            'header' => 'น้ำหนัก'
        ],
        [
            'attribute' => 'age_y',
            'header' => 'อายุ'
        ],
        [
            'attribute' => 'lab_items_name',
            'header' => 'ชื่อแลป'
        ],
        [
            'attribute' => 'lab_order_result',
            'header' => 'ผลแลป'
        ],
        
        [
            'attribute' => 'drug_name',
            'header' => 'ชื่อยา'
        ],
         [
            'attribute' => 'qty',
            'header' => 'จำนวนสั่งใช้'
        ],
         [
            'attribute' => 'units',
            'header' => 'หน่วย'
        ], 
       
        
    ]
])
?>


<?php

/* @var $this yii\web\View */

use kartik\grid\GridView;
use yii\helpers\Html;

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
            'attribute' => 'an',
            'header' => 'AN'
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
            'header' => 'DX0'
        ], 
         [
            'attribute' => 'dx1',
            'header' => 'DX1'
        ],
         [
            'attribute' => 'dx2',
            'header' => 'DX2'
        ],
         [
            'attribute' => 'dx3',
            'header' => 'DX3'
        ],
         [
            'attribute' => 'dx4',
            'header' => 'DX4'
        ],
         [
            'attribute' => 'dx5',
            'header' => 'DX5'
        ],
         [
            'attribute' => 'vstdate_vn_stat',
            'header' => 'วันที่รับบริการ'
        ],
        [
            'attribute' => 'order_date_dtx_department',
            'header' => 'แผนกที่สั่ง DTX ครั้งแรก'
        ],
        [
            'attribute' => 'order_date_dtx',
            'header' => 'วันที่สั่ง DTX ครั้งแรก'
        ],
         [
            'attribute' => 'dtx',
            'header' => 'ผลแลป DTX ครั้งแรก'
        ],
        
         [
            'attribute' => 'order_date_glucose_department',
            'header' => 'แผนกที่สั่ง Glucose ครั้งแรก'
        ],
        [
            'attribute' => 'order_date_glucose',
            'header' => 'วันที่สั่ง Glucose ครั้งแรก'
        ],
         [
            'attribute' => 'glucose',
            'header' => 'ผลแลป Glucose ครั้งแรก'
        ],
        
       
       
       
    ]
])
?>


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
            'attribute' => 'person_id',
            'header' => 'PERSON ID'
        ], 
        [
            'attribute' => 'cid',
            'header' => 'รหัสบัตรประชาชน'
        ],
        [
            'attribute' => 'person_name',
            'header' => 'ชื่อ-สกุล'
        ],
         [
            'attribute' => 'anc_register_date',
            'header' => 'วันที่ลงทะเบียน ANC'
        ],
        [
            'attribute' => 'anc_register_staff',
            'header' => 'ผู้ลงทะเบียน'
        ],  
        [
            'attribute' => 'update_datetime',
            'header' => 'วันที่บันทึกภาวะเสี่ยงล่าสุด'
        ], 

          
    ]
])
?>


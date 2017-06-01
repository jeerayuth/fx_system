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
            'attribute' => 'pt_name',
            'header' => 'ชื่อ-สกุล'
        ], 
        [
            'attribute' => 'addrpart',
            'header' => 'บ้านเลขที่'
        ],
        [
            'attribute' => 'moopart',
            'header' => 'หมู่ที่'
        ],
        [
            'attribute' => 'addresspart',
            'header' => 'ที่อยู่'
        ],
        [
            'attribute' => 'clinic_member_status_name',
            'header' => 'สถานะคนไข้'
        ], 
        [
            'attribute' => 'glucose_lab_second_last',
            'header' => 'gluclose รองสุดท้าย'
        ], 
         [
            'attribute' => 'glucose_lab_result_last',
            'header' => 'gluclose ครั้งสุดท้าย'
        ], 
        
        
              
       
       
    ]
])
?>


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
            'attribute' => 'health_med_service_type_name',
            'header' => 'ประเภทคนไข้'
        ],
        [
            'attribute' => 'service_date',
            'header' => 'วันที่รับบริการ'
        ],            
        [
            'attribute' => 'health_med_treatment_type_name',
            'header' => 'ประเภทการรับบริการ',
        ],
        [
            'attribute' => 'health_med_service_result_name',
            'header' => 'ผลการรับบริการ',
        ],
       
       
    ]
])
?>


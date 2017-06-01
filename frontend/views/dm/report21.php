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
            'attribute' => 'clinic_member_status_name',
            'header' => 'สถานะคนไข้'
        ], 
        [
            'attribute' => 'max_dtx_department',
            'header' => 'จุดที่สั่ง DTX ล่าสุด'
        ], 
         [
            'attribute' => 'max_dtx_order_date',
            'header' => 'วันที่สั่ง DTX ล่าสุด'
        ], 
         [
            'attribute' => 'max_dtx_order_result',
            'header' => 'ผล DTX ล่าสุด'
        ], 
         [
            'attribute' => 'max_glucose_department',
            'header' => 'จุดที่สั่ง Glucose ล่าสุด'
        ], 
        [
            'attribute' => 'max_glucose_order_date',
            'header' => 'วันที่สั่ง Glucose ล่าสุด'
        ], 
         [
            'attribute' => 'max_glucose_order_result',
            'header' => 'ผล Glucose ล่าสุด'
        ], 
        
        
       
        
       
       
       
    ]
])
?>


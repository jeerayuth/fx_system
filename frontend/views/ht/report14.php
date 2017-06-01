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
            'attribute' => 'max_vstdate',
            'header' => 'วันที่รับบริการล่าสุด'
        ], 
        [
            'attribute' => 'height_last',
            'header' => 'ส่วนสูง'
        ], 
         [
            'attribute' => 'height_last_divide2',
            'header' => 'ส่วนสูง/2'
        ], 
        [
            'attribute' => 'waist_last',
            'header' => 'รอบเอว'
        ], 
         [
            'attribute' => 'screen_result_report',
            'header' => 'ผลคำนวณ'
        ], 
        
       
       
       
       
    ]
])
?>


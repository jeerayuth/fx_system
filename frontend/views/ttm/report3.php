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
            'attribute' => 'vstdate',
            'header' => 'วันที่รับบริการ'
        ],
        [
            'attribute' => 'drug_name',
            'header' => 'รายการยาที่สั่งใช้'
        ],            
        [
            'attribute' => 'qty',
            'header' => 'จำนวนสั่งใช้',
        ],
        [
            'attribute' => 'doctor_name',
            'header' => 'แพทย์ผู้สั่ง',
        ],
       
       
    ]
])
?>


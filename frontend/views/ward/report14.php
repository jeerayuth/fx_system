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
            'attribute' => 'regdate',
            'header' => 'วันที่ admit'
        ],
         [
            'attribute' => 'dchdate',
            'header' => 'วันที่จำหน่าย'
        ],
        
         [
            'attribute' => 'pdx',
            'header' => 'โรคหลัก'
        ],
        
        [
            'attribute' => 'department',
            'header' => 'หน่วยงานที่สั่ง'
        ],
         
   
       
          
    ]
])
?>


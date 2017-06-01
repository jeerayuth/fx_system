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
            'attribute' => 'sex',
            'header' => 'เพศ'
        ],
         [
            'attribute' => 'regdate',
            'header' => 'วันที่ลงทะเบียน'
        ],
         [
            'attribute' => 'dchdate',
            'header' => 'วันที่จำหน่าย'
        ],
         [
            'attribute' => 'admdate',
            'header' => 'จำนวนวันนอน'
        ],
         [
            'attribute' => 'pdx',
            'header' => 'โรคหลัก'
        ],
         [
            'attribute' => 'dx0',
            'header' => 'โรครอง1'
        ],
         [
            'attribute' => 'dx1',
            'header' => 'โรครอง2'
        ],
         [
            'attribute' => 'dx2',
            'header' => 'โรครอง3'
        ],
         [
            'attribute' => 'dx3',
            'header' => 'โรครอง4'
        ],
        [
            'attribute' => 'dx4',
            'header' => 'โรครอง5'
        ],
        [
            'attribute' => 'dx5',
            'header' => 'โรครอง6'
        ],
   
       
          
    ]
])
?>


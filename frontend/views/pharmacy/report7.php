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
            'attribute' => 'vn',
            'header' => 'VN'
        ],
        [
            'attribute' => 'hn',
            'header' => 'HN'
        ],
        [
            'attribute' => 'vstdate',
            'header' => 'วันที่รับบริการ'
        ],
        [
            'attribute' => 'rxtime',
            'header' => 'เวลาสั่งจ่ายยา'
        ],
         [
            'attribute' => 'pt_name',
            'header' => 'ชื่อ-สกุล'
        ],
        [
            'attribute' => 'age_y',
            'header' => 'อายุ'
        ],
       
        [
            'attribute' => 'weight',
            'header' => 'น้ำหนัก'
        ],
         [
            'attribute' => 'cc',
            'header' => 'CC'
        ],
         [
            'attribute' => 'pdx',
            'header' => 'PDX'
        ],
         [
            'attribute' => 'diag_second',
            'header' => 'รหัสวินิจฉัยรอง'
        ],
        /*
         [
            'attribute' => 'icode',
            'header' => 'icode'
        ],
         
         */
         [
            'attribute' => 'drug_name',
            'header' => 'ชื่อยา'
        ],
        [
            'attribute' => 'shortlist',
            'header' => 'วิธีใช้'
        ],
         [
            'attribute' => 'qty',
            'header' => 'จำนวน'
        ],
        
    ]
])
?>


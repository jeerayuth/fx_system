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
            'attribute' => 'hn',
            'header' => 'HN'
        ],
        [
            'attribute' => 'pt_name',
            'header' => 'ชื่อ-สกุล'
        ],
        [
            'attribute' => 'xray_items_name',
            'header' => 'รายการที่ทำ'
        ],
        [
            'attribute' => 'report_date',
            'header' => 'วันที่รายงานผล'
        ],
        [
            'attribute' => 'request_time',
            'header' => 'เวลาที่สั่ง'
        ],
        [
            'attribute' => 'report_time',
            'header' => 'เวลารายงานผล'
        ],
    /*
      [
      'attribute' => 'staff',
      'header' => 'login ผู้ปฏิบัติงาน'
      ], */
    ]
])
?>


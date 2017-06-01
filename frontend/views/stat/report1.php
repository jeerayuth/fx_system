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
        'heading' => 'สถิติการใช้งาน : '. $report_name,
        'before' => 'เริ่มระบบเก็บสถิติการใช้งานระบบรายงาน เมื่อ 03 กุมภาพันธ์ 2560',
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
            'attribute' => 'username',
            'header' => 'ชื่อผู้ใช้'
        ],
        [
            'attribute' => 'fullname',
            'header' => 'ชื่อ-สกุล'
        ],
         [
            'attribute' => 'count_use',
            'header' => 'จำนวนครั้งที่ใช้รายงาน'
        ],            
    ]
])
?>

<br/>

<?php

echo GridView::widget([
    'dataProvider' => $dataProvider2,
    'panel' => [
        'heading' => 'ประวัติการใช้งาน : '.$report_name.'  '.$report_name2,
        'before' => 'เริ่มระบบเก็บสถิติการใช้งานระบบรายงาน เมื่อ 03 กุมภาพันธ์ 2560',
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
            'attribute' => 'username',
            'header' => 'ชื่อผู้ใช้'
        ],
        [
            'attribute' => 'fullname',
            'header' => 'ชื่อ-สกุล'
        ],
        [
            'attribute' => 'viewlog',
            'header' => 'วันที่เวลา'
        ],
                  
    ]
])
?>
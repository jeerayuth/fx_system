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
            'attribute' => 'icode',
            'header' => 'ICODE'
        ],
        [
            'attribute' => 'drug_name',
            'header' => 'ชื่อยา'
        ],
        [
            'attribute' => 'drug_unit',
            'header' => 'หน่วย'
        ],
        [
            'attribute' => 'unitprice',
            'header' => 'ราคาขาย(ล่าสุด)/หน่วย'
        ],
         [
            'attribute' => 'unitcost',
            'header' => 'ราคาทุน(ล่าสุด)/หน่วย'
        ],
        [
            'attribute' => 'count_use',
            'header' => 'จำนวนที่ใช้'
        ],
       
        [
            'attribute' => 'sum_price',
            'header' => 'มูลค่าการใช้(ราคาขาย)'
        ],
         [
            'attribute' => 'sum_cost',
            'header' => 'มูลค่าการใช้(ราคาทุน)'
        ],
        
    ]
])
?>


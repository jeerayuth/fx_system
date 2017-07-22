<?php

/* @var $this yii\web\View */
use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
HighchartsAsset::register($this)->withScripts([
	'highcharts-more',
	'themes/grid'
]);


$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>

<?php 

$total = 0; // ผลรวม Point

for ($i = 0; $i < count($rawData); $i++) {
    $total += $rawData[$i]['cal_score']; 
}

?>


<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'heading' => $report_name,
        'before' => "",
        'type' => 'primary',
        'after' => 'ประมวลผล ณ วันที่ ' . date('Y-m-d H:i:s')
    ],
    'export' => [
        'fontAwesome' => true,
        'showConfirmAlert' => false,
        'target' => GridView::TARGET_BLANK
    ],
    'showFooter' => true,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        
      
        [
            'attribute' => 'DATE_S',
            'header' => 'วันที่'
        ],
        [
            'attribute' => 'time_to_start_ea',
            'header' => 'เวลาเริ่มต้นเปิด EA'
        ],
        [
            'attribute' => 'first_open',
            'header' => 'ราคาเริ่มต้นเปิด EA'
        ],
        [
            'attribute' => 'cal_gap_pending_order',
            'header' => 'คำนวณ gap pending'
        ], 
        [
            'attribute' => 'time_to_pending_order_start',
            'header' => 'เวลาที่เริ่มแตะ Pending'
        ],
        [
            'attribute' => 'price_on_pending_start',
            'header' => 'ราคาที่เริ่มแตะ Pending'
        ],
         [
            'attribute' => 'price_on_tp',
            'header' => 'คำนวณ TP'
        ],
        [
            'attribute' => 'price_on_stop_loss',
            'header' => 'คำนวณ SL'
        ],
        [
            'attribute' => 'time_at_low_price',
            'header' => 'เวลาที่ราคาต่ำสุดในคาบเวลา'
        ],
        [
            'attribute' => 'price_at_low',
            'header' => 'ระดับราคาต่ำสุดในคาบเวลา'
        ],
        [
            'attribute' => 'time_at_hight_price',
            'header' => 'เวลาที่ราคาสูงสุดในคาบเวลา'
        ],
        [
            'attribute' => 'price_at_hight',
            'header' => 'ระดับราคาสูงสุดในคาบเวลา'
        ],
        [
            'attribute' => 'time_at_last_close_price',
            'header' => 'เวลาสุดท้ายตามที่เลือก'
        ],
        [
            'attribute' => 'price_at_last_close_price',
            'header' => 'ราคา ณ เวลาสุดท้าย',
            'footerOptions' => ['class'=>'text-right'],
            'footer' => 'รวม'
        ],
        [
            'attribute' => 'cal_score',
            'header' => 'Profit/Loss(Point)',
             'format'=>['decimal',0],
            'footer' => number_format($total),
        ],
   

       
      
          
    ]
])
?>


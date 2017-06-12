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


<div id="chart-range"></div>
<br/>


<?php

//กราฟหาระดับราคา 0-300 ในแต่ละระดับใน timeframe 4 ชั่วโมง
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
$data3 = [];
for ($i = 0; $i < count($rawData_range1); $i++) {
    $data3[] = [
        'name' => $rawData_range1[$i]['time_s'],
        'y' => $rawData_range1[$i]['count_price_by_range'] * 1,
    ];
}
$js_data3 = json_encode($data3);



//กราฟหาระดับราคา 301-600 ในแต่ละระดับใน timeframe 4 ชั่วโมง
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
$data4 = [];
for ($i = 0; $i < count($rawData_range2); $i++) {
    $data4[] = [
        'name' => $rawData_range2[$i]['time_s'],
        'y' => $rawData_range2[$i]['count_price_by_range'] * 1,
    ];
}
$js_data4 = json_encode($data4);



//กราฟหาระดับราคา 601-900 ในแต่ละระดับใน timeframe 4 ชั่วโมง
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
$data5 = [];
for ($i = 0; $i < count($rawData_range3); $i++) {
    $data5[] = [
        'name' => $rawData_range3[$i]['time_s'],
        'y' => $rawData_range3[$i]['count_price_by_range'] * 1,
    ];
}
$js_data5 = json_encode($data5);



//กราฟหาระดับราคา 901-1200 ในแต่ละระดับใน timeframe 4 ชั่วโมง
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
$data6 = [];
for ($i = 0; $i < count($rawData_range4); $i++) {
    $data6[] = [
        'name' => $rawData_range4[$i]['time_s'],
        'y' => $rawData_range4[$i]['count_price_by_range'] * 1,
    ];
}
$js_data6 = json_encode($data6);

?>


<?php

$this->registerJs("   
      
Highcharts.chart('chart-range', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'ข้อมูลระดับราคาเฉลี่ยราย 4 ชั่วโมง ในแดนบวก ประจำปี $year_s เดือน $month_id'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [    
        ],
        crosshair: true
    },
    yAxis: {
       tickInterval: 5     
    },
    tooltip: {
        pointFormat: 'Value: {point.y:,.0f} ครั้ง'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: '0-300',
        data: $js_data3

    }, {
        name: '301-600',
        data: $js_data4

    }, {
        name: '601-900',
        data: $js_data5

    },{
        name: '901-1200',
        data: $js_data6

    } ]
});


");
        
       
// จบ chart
?>

<br/>

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
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
            
         [
            'attribute' => 'time_s',
            'header' => 'เวลา'
        ],         
        [
            'attribute' => 'range1',
            'header' => 'ระดับราคา'
        ], 
        [
            'attribute' => 'count_price_by_range',
            'header' => 'จำนวนครั้ง'
        ], 
              
       
                    
        
    ]
])
?>

<button type="button" class="btn btn-success" onclick = "javascript:(history.go(-1))"><i class="glyphicon glyphicon-menu-left"></i> ย้อนกลับ</button>

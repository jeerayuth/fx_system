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


<div id="chart"></div>

<?php

//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y

$data1 = [];
for ($i = 0; $i < count($rawData); $i++) {
    $data1[] = [
        'name' => $rawData[$i]['time_s'],
        'y' => $rawData[$i]['oh'] * 1,
    ];
}

$data2 = [];
for ($i = 0; $i < count($rawData); $i++) {
    $data2[] = [
        'name' => $rawData[$i]['time_s'],
        'y' => $rawData[$i]['ol'] * 1,
    ];
}

$js_data1 = json_encode($data1);
$js_data2 = json_encode($data2);


// chart
$this->registerJs(" 
    Highcharts.chart('chart', {
    chart: {
        type: 'column'
    },
    tooltip: {
        pointFormat: 'Value: {point.y:,.0f} Point'
    }, 
    title: {
        text: '$report_name'
    },
    xAxis: {
        categories: []
    },
    yAxis: {
            tickInterval: 5
        },
    credits: {
        enabled: false
    },
    series: [{
        name: 'OPEN->Low',
        data: $js_data1
    }, {
        name: 'OPEN->Hight',
        data: $js_data2
    }]
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
            'attribute' => 'date_s',
            'header' => 'วันที่'
        ],
         [
            'attribute' => 'time_s',
            'header' => 'เวลา'
        ],
        [
            'attribute' => 'open',
            'header' => 'OPEN'
        ],
        [
            'attribute' => 'hight',
            'header' => 'HIGHT'
        ],
        [
            'attribute' => 'low',
            'header' => 'LOW'
        ],
        [
            'attribute' => 'close',
            'header' => 'CLOSE'
        ],
          [
            'attribute' => 'oh',
            'header' => 'OH',
              'format' => ['decimal',0] 
        ],
        [
            'attribute' => 'ol',
            'header' => 'OL',
             'format' => ['decimal',0] 
        ],
        
          
                    
        
    ]
])
?>

<button type="button" class="btn btn-success" onclick = "javascript:(history.go(-1))"><i class="glyphicon glyphicon-menu-left"></i> ย้อนกลับ</button>

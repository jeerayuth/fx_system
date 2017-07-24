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


<div id="chart" style="min-width: 310px; height: 500px; margin: 0 auto"></div>

<?php

//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y

$data1 = [];
for ($i = 0; $i < count($rawData); $i++) {
    $data1[] = [
        'name' => $rawData[$i]['month_s'],
        'y' => $rawData[$i]['oh'] * 1,
    ];
}

$data2 = [];
for ($i = 0; $i < count($rawData); $i++) {
    $data2[] = [
        'name' => $rawData[$i]['month_s'],
        'y' => $rawData[$i]['ol'] * 1,
    ];
}


$data3 = [];
for ($i = 0; $i < count($rawData2); $i++) {
    $data3[] = [
        'name' => $rawData2[$i]['month_s'],
        'y' => $rawData2[$i]['oh'] * 1,
    ];
}

$data4 = [];
for ($i = 0; $i < count($rawData2); $i++) {
    $data4[] = [
        'name' => $rawData2[$i]['month_s'],
        'y' => $rawData2[$i]['ol'] * 1,
    ];
}

$data5 = [];
for ($i = 0; $i < count($rawData3); $i++) {
    $data5[] = [
        'name' => $rawData3[$i]['month_s'],
        'y' => $rawData3[$i]['oh'] * 1,
    ];
}

$data6 = [];
for ($i = 0; $i < count($rawData3); $i++) {
    $data6[] = [
        'name' => $rawData3[$i]['month_s'],
        'y' => $rawData3[$i]['ol'] * 1,
    ];
}


$data7 = [];
for ($i = 0; $i < count($rawData4); $i++) {
    $data7[] = [
        'name' => $rawData4[$i]['month_s'],
        'y' => $rawData4[$i]['oh'] * 1,
    ];
}

$data8 = [];
for ($i = 0; $i < count($rawData4); $i++) {
    $data8[] = [
        'name' => $rawData4[$i]['month_s'],
        'y' => $rawData4[$i]['ol'] * 1,
    ];
}




$js_data1 = json_encode($data1);
$js_data2 = json_encode($data2);
$js_data3 = json_encode($data3);
$js_data4 = json_encode($data4);
$js_data5 = json_encode($data5);
$js_data6 = json_encode($data6);
$js_data7 = json_encode($data7);
$js_data8 = json_encode($data8);


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
        categories: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม']
    },
    yAxis: {
            tickInterval: 5
        },
    credits: {
        enabled: false
    },
    series: [{
        name: '',
        data: $js_data1
    }, {
        name: '',
        data: $js_data2
    }, {
        name: '',
        data: $js_data3
    }, {
        name: '',
        data: $js_data4
    }, {
        name: '',
        data: $js_data5
    }, {
        name: '',
        data: $js_data6
    }, {
        type: 'spline',
        name: 'Average Positive',
        data: $js_data7,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'Average Negative',
        data: $js_data8,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[2],
            fillColor: 'white'
        }
    }]
});
");
// จบ chart
?>



<br/>
<center>
    <button type="button" class="btn btn-success" onclick = "javascript:(history.go(-1))"><i class="glyphicon glyphicon-menu-left"></i> ย้อนกลับ</button>   
    <a href="index.php?r=sql/report3&sub_currency_id=<?php echo  $sub_currency_id; ?>&year_s=<?php echo $year_s;?>" class="btn btn-danger"><i class="glyphicon glyphicon-menu-right"></i> ข้อมูลรายสัปดาห์</a>
</center>
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
            'attribute' => 'month_s',
            'header' => 'เดือน'
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
        
        /*
        [
            'attribute' => '',
            'header' => '',
            'format' => 'raw',
            'value' => function($model) use ($sub_currency_id,$year_s)  {
                    $month_id = $model['month_id'];
                return Html::a(Html::encode('ข้อมูลรายสัปดาห์'), 
                    ['sql/report3','sub_currency_id' => $sub_currency_id, 'year_s'=> $year_s, 'month_id'=>$month_id]);
                    }
                ] */
                
    ]
]) 
?>


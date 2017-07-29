<?php
/* @var $this yii\web\View */
use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use miloschuman\highcharts\Highstock;
use yii\web\JsExpression;
use kartik\datecontrol\Module;
use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;
use kartik\time\TimePicker;
\conquer\momentjs\MomentjsAsset::register($this);
HighchartsAsset::register($this)->withScripts([
	'highcharts-more',
	'themes/grid'
]);
$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div id="chart" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
    </div>
</div>


<?php
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y

$categ = [];
for ($i = 0; $i < count($rawData); $i++) {
    $categ[] = $rawData[$i]['time_s'];
}
$js_categ = implode("','", $categ);

//วันจันทร์
$data1 = [];
for ($i = 0; $i < count($rawData); $i++) {
    $data1[] = [
        'name' => $rawData[$i]['date_s'],
        'y' => $rawData[$i]['oh'] * 1,
    ];
}

$data2 = [];
for ($i = 0; $i < count($rawData); $i++) {
    $data2[] = [
        'name' => $rawData[$i]['date_s'],
        'y' => $rawData[$i]['ol'] * 1,
    ];
}


//วันอังคาร
$data3 = [];
for ($i = 0; $i < count($rawData2); $i++) {
    $data3[] = [
        'name' => $rawData2[$i]['date_s'],
        'y' => $rawData2[$i]['oh'] * 1,
    ];
}

$data4 = [];
for ($i = 0; $i < count($rawData2); $i++) {
    $data4[] = [
        'name' => $rawData2[$i]['date_s'],
        'y' => $rawData2[$i]['ol'] * 1,
    ];
}

//วันพุธ
$data5 = [];
for ($i = 0; $i < count($rawData3); $i++) {
    $data5[] = [
        'name' => $rawData3[$i]['date_s'],
        'y' => $rawData3[$i]['oh'] * 1,
    ];
}

$data6 = [];
for ($i = 0; $i < count($rawData3); $i++) {
    $data6[] = [
        'name' => $rawData3[$i]['date_s'],
        'y' => $rawData3[$i]['ol'] * 1,
    ];
}


//วันพฤหัสบดี
$data7 = [];
for ($i = 0; $i < count($rawData4); $i++) {
    $data7[] = [
        'name' => $rawData4[$i]['date_s'],
        'y' => $rawData4[$i]['oh'] * 1,
    ];
}

$data8 = [];
for ($i = 0; $i < count($rawData4); $i++) {
    $data8[] = [
        'name' => $rawData4[$i]['date_s'],
        'y' => $rawData4[$i]['ol'] * 1,
    ];
}


//วันศุกร์
$data9 = [];
for ($i = 0; $i < count($rawData5); $i++) {
    $data9[] = [
        'name' => $rawData5[$i]['date_s'],
        'y' => $rawData5[$i]['oh'] * 1,
    ];
}

$data10 = [];
for ($i = 0; $i < count($rawData5); $i++) {
    $data10[] = [
        'name' => $rawData5[$i]['date_s'],
        'y' => $rawData5[$i]['ol'] * 1,
    ];
}
 
 
//convert array to json string;
$js_data1 = json_encode($data1);
$js_data2 = json_encode($data2);
$js_data3 = json_encode($data3);
$js_data4 = json_encode($data4);
$js_data5 = json_encode($data5);
$js_data6 = json_encode($data6);
$js_data7 = json_encode($data7);
$js_data8 = json_encode($data8);
$js_data9 = json_encode($data9);
$js_data10 = json_encode($data10);

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
        categories: ['$js_categ'],
    },
    yAxis: {
            tickInterval: 5
        },
    credits: {
        enabled: false
    },
    series: [{
        type: 'spline',
        name: 'แกนบวกวันจันทร์',
        data: $js_data1,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนลบวันจันทร์',
        data: $js_data2,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนบวกวันอังคาร',
        data: $js_data3,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนลบวันอังคาร',
        data: $js_data4,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนบวกวันพุธ',
        data: $js_data5,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนลบวันพุธ',
        data: $js_data6,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนบวกวันพฤหัสบดี',
        data: $js_data7,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนลบวันพฤหัสบดี',
        data: $js_data8,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนบวกวันศุกร์',
        data: $js_data9,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนลบวันศุกร์',
        data: $js_data10,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }]
});
");
// จบ chart
?>



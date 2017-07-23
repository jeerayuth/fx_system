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


<div id="chart-range" style="height: 600px; margin: 0 auto"></div>
<br/>

<?php
// เตรียมข้อมูลหัวข้อระดับราคา,เวลา แกนบวก
$text_positive = array();
$data_positive = [];
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
// ข้อมูลชุดที่ 1 ค่าบวก
$data1 = [];
for ($i = 0; $i < count($rawData_positive); $i++) {
    $text_positive = "'" . $rawData_positive[$i]['title'] . "'";
    array_push($data_positive, $text_positive);
    $data1[] = [
        'name' => $rawData_positive[$i]['price_range'],
        'y' => $rawData_positive[$i]['count_price_by_range'] * 1,
    ];
}
//convert array to string;
$text_title_positive = implode(",", $data_positive);
// json encode
$js_data1 = json_encode($data1);


// เตรียมข้อมูลหัวข้อระดับราคา,เวลา แกนลบ
$text_negative = array();
$data_negative = [];
// ข้อมูลชุดที่ 2 ค่าลบ
$data2 = [];
for ($i = 0; $i < count($rawData_negative); $i++) {
    $text_negative = "'" . $rawData_negative[$i]['title'] . "'";
    array_push($data_negative, $text_negative);
    $data2[] = [
        'name' => $rawData_negative[$i]['price_range'],
        'y' => $rawData_negative[$i]['count_price_by_range'] * 1,
    ];
}
//convert array to string;
$text_title_negative = implode(",", $data_negative);
$js_data2 = json_encode($data2);




// chart
$this->registerJs(" 

Highcharts.chart('chart-range', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'กราฟสถิติแบบพิรามิต'
        },
        subtitle: {
            text: '$report_name'
        },
        xAxis: [{
            categories: [$text_title_positive],
            reversed: false,
            labels: {
                step: 1
            }
        }, { // mirror axis on right side
            opposite: true,
            reversed: false,
            categories: [$text_title_negative],
            linkedTo: 0,
            labels: {
                step: 1
            }
        }],
        yAxis: {
            title: {
                text: null
            },
            labels: {
                formatter: function () {
                    return Math.abs(this.value) ;
                }
            }
        },

        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '<br/>' +
                    'จำนวน: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0) +' ครั้ง';
            }
        },

        series: [{
            name: 'ค่าบวก',
            data: $js_data1
            },{
            name: 'ค่าลบ',
            data: $js_data2
        }]
});

");
?>


<center>
<button type="button" class="btn btn-success" onclick = "javascript:(history.go(-1))"><i class="glyphicon glyphicon-menu-left"></i> ย้อนกลับ</button>
</center>


<?php
/*
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
            'attribute' => 'price',
            'header' => 'ระดับราคา'
        ],
        [
            'attribute' => 'sum_range',
            'header' => 'จำนวนครั้ง'
        ],
    ]
]) */
?>


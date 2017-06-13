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


<div id="chart1" style="height: 600px; margin: 0 auto"></div>
<br/>

<?php
$text = array();
$data = [];
for ($i = 0; $i < count($rawData); $i++) {
    $text = "'" . $rawData[$i]['price_range'] . "'";
    array_push($data, $text);
}
//convert array to string;
$text_title = implode(",", $data);



//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
// ข้อมูลชุดที่ 1 ค่าบวก

$data1 = [];
for ($i = 0; $i < count($rawData); $i++) {
    $data1[] = [
        'name' => $rawData[$i]['price_range'],
        'y' => $rawData[$i]['count_price_by_range'] * 1,
    ];
}
$js_data1 = json_encode($data1);


// ข้อมูลชุดที่ 2 ค่าลบ
$data2 = [];
for ($i = 0; $i < count($rawData_negative); $i++) {
    $data2[] = [
        'name' => $rawData_negative[$i]['price_range'],
        'y' => $rawData_negative[$i]['count_price_by_range'] * 1,
    ];
}
$js_data2 = json_encode($data2);




// chart
$this->registerJs(" 
 

Highcharts.chart('chart1', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'สถิติ'
        },
        subtitle: {
            text: '$report_name'
        },
        xAxis: [{
            categories: [$text_title],
            reversed: false,
            labels: {
                step: 1
            }
        }, { // mirror axis on right side
            opposite: true,
            reversed: false,
            categories: [$text_title],
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
            name: 'ค่าลบ',
            data: $js_data2
        }, {
            name: 'ค่าบวก',
            data: $js_data1
   }]
});

");
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
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'time_s',
            'header' => 'เวลา'
        ],
        [
            'attribute' => 'price_range',
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

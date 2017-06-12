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

//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y

$data1 = [];
for ($i = 0; $i < count($rawData); $i++) {
    $data1[] = [
        'name' => $rawData[$i]['title'],
        'y' => $rawData[$i]['count_price_by_range'] * 1,
    ];
}

$js_data1 = json_encode($data1);


 

// chart
$this->registerJs(" 
 

Highcharts.chart('chart1', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'ใส่หัวข้อ'
        },
        subtitle: {
            text: '$report_name'
        },
        xAxis: [{
            categories: ['0-300', '301-600', '601-900', '901-1200',
        '1201-1500', '1501-1800', '1801-2100', '2400+ '],
            reversed: false,
            labels: {
                step: 1
            }
        }, { // mirror axis on right side
            opposite: true,
            reversed: false,
            categories: ['0-300', '301-600', '601-900', '901-1200',
        '1201-1500', '1501-1800', '1801-2100', '2400+ '],
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
                    return Math.abs(this.value) + '%';
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
                return '<b>' + this.series.name + ', age ' + this.point.category + '</b><br/>' +
                    'Population: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
            }
        },

        series: [{
            name: 'Negative',
            data: []
        }, {
            name: 'Positive',
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

<?php
/* @var $this yii\web\View */

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>


<div style="display:none">
    <?php
    echo Highcharts::widget([
        'scripts' => [
            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
            'themes/grid'        // applies global 'grid' theme to all charts
        ],
    ]);
    ?>  
</div>


<div id="chart"></div>

<?php
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
$data = [];
$sum = 0;
foreach($rawData as $r){
    $data[] = [
        'name' => $r['hosp_name'],
        'y' => intval($r['count_hn']),
    ];
    $sum += $r['count_hn'];
}

$js_data = json_encode($data);

// chart
$this->registerJs(" 
    $(function () {
    $('#chart').highcharts({
        chart: {
            type: 'pie',
        },
         credits: {
            enabled: false
        },
        title: {
            text: '$report_name'
        },
        
        tooltip: {
            enabled: false,
        },
                         
         yAxis: {
            min: 0,
            title: {
                text: 'จำนวน'
            },
            
        },
         xAxis: {
            type: 'category'
        },
       legend: {
            enabled: true
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y:.0f} คน',
                }
            }
        },
        series: [{
                name: 'จำนวน',
                colorByPoint: true,
                data:$js_data
        }]
     },  function(chart) { // on complete
        var total = $sum;    
        chart.renderer.text('รวม: ' + total + ' คน', 20, 105)
            .css({
                color: '#4572A7',
                fontSize: '16px'
            })
        .add();
        });
    });
");
// จบ chart
?>


<br/>


<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => $report_name,
        'after' => 'ประมวลผล ณ วันที่ ' . date('Y-m-d H:i:s')
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'hosp_name',
            'header' => 'พื้นที่'
        ],
        [
            'attribute' => 'count_hn',
            'header' => 'จำนวนคนไข้(คน)',
            'format' => 'raw',
            'value' => function($model) {
                $hosp_area = $model['hosp_area'];
                $count_hn = $model['count_hn'];
                return Html::a(Html::encode($count_hn), ['ht/report2', 'hosp_area' => $hosp_area]);
            }
                ]
            ]
        ])
        ?>

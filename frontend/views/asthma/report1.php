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
for ($i = 0; $i < count($rawData); $i++) {
    $data[] = [
        'name' => $rawData[$i]['tumbol'],
        'y' => $rawData[$i]['count_hn'] * 1,
    ];
}

$js_data = json_encode($data);

// chart
$this->registerJs(" 
    $(function () {
    $('#chart').highcharts({
        chart: {
            type: 'column'
        },
         credits: {
            enabled: false
        },
        title: {
            text: '$report_name'
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
                    enabled: true
                }
            }
        },
        series: [{
                name: 'จำนวน',
                colorByPoint: true,
                data:$js_data
        }]
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
            'attribute' => 'tumbol',
            'header' => 'ตำบล'
        ],
        [
            'attribute' => 'address',
            'header' => 'ที่อยู่'
        ],
        [
            'attribute' => 'count_hn',
            'header' => 'จำนวนคนไข้',
            'format' => 'raw',
            'value' => function($model) {
                $addressid = $model['addressid'];
                $count_hn = $model['count_hn'];
                return Html::a(Html::encode($count_hn), ['asthma/report2', 'addressid' => $addressid]);
            }
                ]
            ]
        ])
        ?>

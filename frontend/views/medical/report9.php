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
        'name' => $r['text'],
        'y' => intval($r['count_an']),
    ];
    $sum += $r['count_an'];
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
                    format: '<b>{point.name}</b>: {point.y:.0f} ครั้ง',
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
        chart.renderer.text('รวมยืมทั้งหมด: ' + total + ' ครั้ง', 20, 105)
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
        'heading' => $report_name,
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
            'attribute' => 'text',
            'header' => 'ยืม-คืน Chart ผู้ป่วยใน'
        ],
      
        [
            'attribute' => 'count_an',
            'header' => 'จำนวนครั้งที่ยืม',
            'format' => 'raw',
            'value' => function($model) use ($datestart,$dateend) {
                $hosp_area = $model['text'];
                $count_hn = $model['count_an'];
                $type_id = $model['type_id'];
                return Html::a(Html::encode($count_hn), 
                    ['medical/report10','type_id' => $type_id, 'datestart'=>$datestart, 'dateend'=>$dateend],['target'=>'_blank']);
                    }
                ]
            ]
        ])
        ?>

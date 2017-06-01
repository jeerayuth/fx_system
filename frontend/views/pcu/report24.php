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
        'name' => $rawData[$i]['title'],
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
            text: '$report_name' + '  ปีงบประมาณ ' + $begin_year
        },
        
         yAxis: {
            min: 0,
            title: {
                text: 'จำนวนคน'
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
                name: 'รายการ',
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
        'heading' => $report_name .' ปีงบประมาณ '. $begin_year,
        'before' => $details,
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
            'attribute' => 'title',
            'header' => 'หัวข้อ'
        ],
        [
            'attribute' => 'count_hn',
            'header' => 'จำนวนคน',
            'format' => 'raw',
            'value' => function($model) use ($begin_year) {
                $title = $model['title'];
                $count_hn = $model['count_hn'];
                $options = $model['options'];
                return Html::a(Html::encode($count_hn), 
                    ['pcu/report25', 'title'=>$title,'options' => $options, 'begin_year' => $begin_year],['target'=>'_blank']);
                    }
                ],
                            
    ]
])
?>


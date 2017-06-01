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
for ($i = 0; $i < count($rawData_graph); $i++) {
    $data[] = [
        'name' => $rawData_graph[$i]['doctor_name'],
        'y' => $rawData_graph[$i]['sum_price'] * 1,
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
            text: '$report_name_graph'
        },
        
         yAxis: {
            min: 0,
            title: {
                text: 'มูลค่าการสั่งใช้ยาแพทย์แผนไทย(บาท)'
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
                name: 'แพทย์ผู้สั่งใช้ยาแพทย์แผนไทย',
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
        'heading' => $report_name,
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
            'attribute' => 'doctor_name',
            'header' => 'ชื่อแพทย์ผู้สั่ง'
        ],
        [
            'attribute' => 'count_hn',
            'header' => 'จำนวนคนไข้ที่สั่งใช้(คน)'
        ],
        [
            'attribute' => 'count_visit',
            'header' => 'จำนวนครั้งที่รับบริการ(ครั้ง)'
        ],
        /*
        [
            'attribute' => 'count_useage',
            'header' => 'จำนวนครั้งที่สั่งใช้'
        ],
        [
            'attribute' => 'sum_qty',
            'header' => 'ปริมาณสั่งใช้'
        ],
         
         */
        [
            'attribute' => 'sum_price',
            'header' => 'มูลค่าการใช้ยาแพทย์แผนไทย(บาท)'
        ],
        
       
         
        
    ]
])
?>


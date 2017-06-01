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


<div class="row">
    <div class="col-md-6">
        <div id="chart1"></div>
    </div>
     <div class="col-md-6">
        <div id="chart2"></div>
    </div>
</div>



<?php
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
$data = [];
for ($i = 0; $i < count($rawData2); $i++) {
    $data[] = [
        'name' => $rawData2[$i]['drug_name'],
        'y' => $rawData2[$i]['count_use'] * 1,
    ];
}

$js_data = json_encode($data);


// chart
$this->registerJs(" 
    $(function () {
    $('#chart1').highcharts({
        chart: {
            type: 'column'
        },
         credits: {
            enabled: false
        },
        title: {
            text: '$report_name2'
        },
        
         yAxis: {
            min: 0,
            title: {
                text: 'จำนวนครั้งการสั่งใช้ (ครั้ง)'
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
                name: 'รายการยาปฏิชีวนะ',
                colorByPoint: true,
                data:$js_data
        }]
     });
    });
");
// จบ chart
?>


<br/>
<br/>



<?php
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
$data2 = [];
for ($i = 0; $i < count($rawData2); $i++) {
    $data2[] = [
        'name' => $rawData2[$i]['drug_name'],
        'y' => $rawData2[$i]['count_an'] * 1,
    ];
}

$js_data2 = json_encode($data2);


// chart
$this->registerJs(" 
    $(function () {
    $('#chart2').highcharts({
        chart: {
            type: 'column'
        },
         credits: {
            enabled: false
        },
        title: {
            text: '$report_name3'
        },
        
         yAxis: {
            min: 0,
            title: {
                text: 'จำนวน admit การสั่งใช้ (ครั้ง)'
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
                name: 'รายการยาปฏิชีวนะ',
                colorByPoint: true,
                data:$js_data2
        }]
     });
    });
");
// จบ chart
?>



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
            'attribute' => 'hn',
            'header' => 'HN'
        ],
        [
            'attribute' => 'an',
            'header' => 'AN'
        ],
         [
            'attribute' => 'pt_name',
            'header' => 'ชื่อ-สกุล'
        ],
        [
            'attribute' => 'vstdate',
            'header' => 'วันที่สั่งใช้ยา'
        ],
  
        [
            'attribute' => 'pdx',
            'header' => 'รหัสวินิจฉัยหลัก'
        ],
        [
            'attribute' => 'drug_name',
            'header' => 'รายการยา'
        ],
        
        [
            'attribute' => 'diag_second',
            'header' => 'รหัสวินิจฉัยรอง'
        ],
    ]
])
?>


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
        <div id="chart"></div>
    </div>
    <div class="col-md-6">
        <div id="chart3"></div>
    </div>
</div>

<br/>

<div class="row">
     <div class="col-md-12">
        <div id="chart4"></div>
    </div>
</div>


<?php
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
$data = [];
$sum = 0;
foreach($rawData2 as $r){
    $data[] = [
        'name' => $r['emergen_type'],
        'y' => intval($r['count_vn']),
    ];
    $sum += $r['count_vn'];
}

$js_data = json_encode($data);




//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
$data3 = [];
$sum3 = 0;
foreach($rawData3 as $r3){
    $data3[] = [
        'name' => $r3['emergen_level'],
        'y' => intval($r3['count_vn']),
    ];
    $sum3 += $r3['count_vn'];
}

$js_data3 = json_encode($data3);




//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
$data4 = [];
$sum4 = 0;
foreach($rawData4 as $r4){
    $data4[] = [
        'name' => $r4['textname'],
        'y' => intval($r4['count_vn']),
    ];
    $sum4 += $r4['count_vn'];
}

$js_data4 = json_encode($data4);




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
            text: 'กราฟผู้ป่วยที่รับบริการที่ห้องฉุกเฉิน(แยกตามความเร่งด่วน)'
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
        chart.renderer.text('รวม: ' + total + ' ครั้ง', 20, 105)
            .css({
                color: '#4572A7',
                fontSize: '16px'
            })
        .add();
        });
    });
");
// จบ chart



// chart
$this->registerJs(" 
    $(function () {
    $('#chart3').highcharts({
        chart: {
            type: 'pie',
        },
         credits: {
            enabled: false
        },
        title: {
            text: 'กราฟผู้ป่วยที่รับบริการที่ห้องฉุกเฉิน(แยกตามระดับความฉุกเฉิน)'
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
                data:$js_data3
        }]
     },  function(chart) { // on complete
        var total = $sum3;    
        chart.renderer.text('รวม: ' + total + ' ครั้ง', 20, 105)
            .css({
                color: '#4572A7',
                fontSize: '16px'
            })
        .add();
        });
    });
");
// จบ chart




// chart
$this->registerJs(" 
    $(function () {
    $('#chart4').highcharts({
        chart: {
            type: 'pie',
        },
         credits: {
            enabled: false
        },
        title: {
            text: 'กราฟผู้ป่วยที่รับบริการที่ห้องฉุกเฉิน(แยกตามเวรปฏิบัติงาน)'
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
                data:$js_data4
        }]
     },  function(chart) { // on complete
        var total = $sum4;    
        chart.renderer.text('รวม: ' + total + ' ครั้ง', 20, 105)
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
            'attribute' => 'pt_name',
            'header' => 'ชื่อผู้ป่วย'
        ],
        [
            'attribute' => 'vstdate',
            'header' => 'วันที่รับบริการ'
        ],
        [
            'attribute' => 'vsttime',
            'header' => 'เวลาที่มา'
        ],
        [
            'attribute' => 'spclty_name',
            'header' => 'ประเภทคลินิก'
        ],
         [
            'attribute' => 'er_pt_type_name',
            'header' => 'ประเภทผู้ป่วย'
        ],     
        [
            'attribute' => 'emergency_name',
            'header' => 'ความเร่งด่วน'
        ],
        [
            'attribute' => 'er_emergency_level_name',
            'header' => 'ระดับความฉุกเฉิน'
        ],
        [
            'attribute' => 'dch_name',
            'header' => 'สถานะภาพ'
        ],
        [
            'attribute' => 'icd10',
            'header' => 'Diag'
        ],
        [
            'attribute' => 'item_money',
            'header' => 'ค่าบริการ'
        ],
        
         [
            'attribute' => 'pttype_name',
            'header' => 'สิทธิ์การรักษา'
        ],
    ]
])
?>


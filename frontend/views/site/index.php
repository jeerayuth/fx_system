<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
$this->title = 'ระบบศูนย์ข้อมูลและสารสนเทศ';
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

<!--
<ul class="nav nav-tabs">
    <li><a data-toggle="tab" href="#">ข้อมูลสถิติทั่วไป รพ.ละแม => </a></li>
    <li><a data-toggle="tab" href="#menu1">ผู้ป่วยนอก</a></li>
    <li><a data-toggle="tab" href="#menu2">ผู้ป่วยใน</a></li>
</ul>
-->

<div class="row">
    <div class="col-md-12">
        <div id="chart8"></div>
    </div>
</div>

<br/>

<div class="row">
    <div class="col-md-6">
        <div id="chart6"></div>
    </div>
    <div class="col-md-6">
        <div id="chart7"></div>
    </div>
</div>


<br/>

<div class="row">
    <div class="col-md-6">
        <div id="chart1"></div>
    </div>
    <div class="col-md-6">
        <div id="chart2"></div>
    </div>
</div>






<br/>

<div class="row">
    <div class="col-md-12">
        <div id="chart3"></div>
    </div>
</div>

<br/>


<div class="row">
    <div class="col-md-6">
        <div id="chart4"></div>
    </div>
    <div class="col-md-6">
        <div id="chart5"></div>
    </div>
</div>


<?php
//เตรียมชุดข้อมูลไปใส่ให้กราฟ
$data1 = [];
$sum1 = 0;
foreach ($rawData1 as $r) {
    $data1[] = [
        'name' => $r['tumbol'],
        'y' => intval($r['count_hn']),
    ];
    $sum1 += $r['count_hn'];
}


//เตรียมชุดข้อมูลไปใส่ให้กราฟ
$data2 = [];
$sum2 = 0;
foreach ($rawData2 as $r) {
    $data2[] = [
        'name' => $r['tumbol'],
        'y' => intval($r['count_hn']),
    ];
    $sum2 += $r['count_hn'];
}


//เตรียมชุดข้อมูลไปใส่ให้กราฟ
$data3 = [];
$sum3 = 0;
foreach ($rawData3 as $r) {
    $data3[] = [
        'name' => $r['tumbol'],
        'y' => intval($r['count_hn']),
    ];
    $sum3 += $r['count_hn'];
}


//เตรียมชุดข้อมูลไปใส่ให้กราฟ
$data4 = [];
$sum4 = 0;
foreach ($rawData4 as $r) {
    $data4[] = [
        'name' => $r['tumbol'],
        'y' => intval($r['count_hn']),
    ];
    $sum4 += $r['count_hn'];
}


//เตรียมชุดข้อมูลไปใส่ให้กราฟ
$data5 = [];
$sum5 = 0;
foreach ($rawData5 as $r) {
    $data5[] = [
        'name' => $r['tumbol'],
        'y' => intval($r['count_hn']),
    ];
    $sum5 += $r['count_hn'];
}


//เตรียมชุดข้อมูลไปใส่ให้กราฟ
$data6 = [];
$sum6 = 0;

for ($i = 0; $i < count($rawData6); $i++) {
    $data6[] = [
        'name' => $rawData6[$i]['vstmonth'],
        'y' => $rawData6[$i]['count_vn_opd'] * 1,
    ];
}


//เตรียมชุดข้อมูลไปใส่ให้กราฟ
$data7 = [];
$sum7 = 0;

for ($i = 0; $i < count($rawData7); $i++) {
    $data7[] = [
        'name' => $rawData7[$i]['group_date'],
        'y' => $rawData7[$i]['count_an_ipd'] * 1,
    ];
}


//เตรียมชุดข้อมูลไปใส่ให้กราฟ
$data8 = [];
$sum8  = 0;
foreach ($rawData8 as $r) {
    $data8[] = [
        'name' => $r['name'],
        'y' => intval($r['count_report']),
    ];
    $sum8 += $r['count_report'];
}

$js_data1 = json_encode($data1);
$js_data2 = json_encode($data2);
$js_data3 = json_encode($data3);
$js_data4 = json_encode($data4);
$js_data5 = json_encode($data5);
$js_data6 = json_encode($data6);
$js_data7 = json_encode($data7);
$js_data8 = json_encode($data8);


// Chart1
$this->registerJs(" 
    $(function () {
    $('#chart1').highcharts({
        chart: {
            type: 'pie',
        },
         credits: {
            enabled: false
        },
        title: {
            text: '$report_name1'
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
                data:$js_data1
        }]
     },  function(chart) { // on complete
        var total = $sum1;    
        chart.renderer.text('รวม: ' + total + ' คน', 20, 105)
            .css({
                color: '#4572A7',
                fontSize: '16px'
            })
        .add();
        });
    });
");
// จบ chart1
// Chart2
$this->registerJs(" 
    $(function () {
    $('#chart2').highcharts({
        chart: {
            type: 'pie'
        },
         credits: {
            enabled: false
        },
        title: {
            text: '$report_name2'
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
                data:$js_data2
        }]
     },  function(chart) { // on complete
        var total = $sum2;    
        chart.renderer.text('รวม: ' + total + ' คน', 20, 105)
            .css({
                color: '#4572A7',
                fontSize: '16px'
            })
        .add();
        });
    });
");
// จบ chart2
// Chart3
$this->registerJs(" 
    $(function () {
    $('#chart3').highcharts({
        chart: {
            type: 'pie'
        },
         credits: {
            enabled: false
        },
        title: {
            text: '$report_name3'
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
                data:$js_data3
        }]
     },  function(chart) { // on complete
        var total = $sum3;    
        chart.renderer.text('รวม: ' + total + ' คน', 20, 80)
            .css({
                color: '#4572A7',
                fontSize: '16px'
            })
        .add();
        });
    });
");
// จบ chart3
// Chart4
$this->registerJs(" 
    $(function () {
    $('#chart4').highcharts({
        chart: {
            type: 'pie'
        },
         credits: {
            enabled: false
        },
        title: {
            text: '$report_name4'
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
                data:$js_data4
        }]
     },  function(chart) { // on complete
        var total = $sum4;    
        chart.renderer.text('รวม: ' + total + ' คน', 20, 80)
            .css({
                color: '#4572A7',
                fontSize: '16px'
            })
        .add();
        });
    });
");
// จบ chart4
// Chart5
$this->registerJs(" 
    $(function () {
    $('#chart5').highcharts({
        chart: {
            type: 'pie'
        },
         credits: {
            enabled: false
        },
        title: {
            text: '$report_name5'
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
                data:$js_data5
        }]
     },  function(chart) { // on complete
        var total = $sum5;    
        chart.renderer.text('รวม: ' + total + ' คน', 20, 80)
            .css({
                color: '#4572A7',
                fontSize: '16px'
            })
        .add();
        });
    });
");
// จบ chart5
// chart6
$this->registerJs(" 
    $(function () {
    $('#chart6').highcharts({
        chart: {
            type: 'column'
        },
         credits: {
            enabled: false
        },
        title: {
            text: '$report_name6'
        },
        
         yAxis: {
            min: 0,
            title: {
                text: 'จำนวน visit คนไข้ opd(ครั้ง)'
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
                name: 'เดือน',
                colorByPoint: true,
                data:$js_data6
        }]
     });
    });
");
// จบ chart
// chart7
$this->registerJs(" 
    $(function () {
    $('#chart7').highcharts({
        chart: {
            type: 'column'
        },
         credits: {
            enabled: false
        },
        title: {
            text: '$report_name7'
        },
        
         yAxis: {
            min: 0,
            title: {
                text: 'จำนวน admit คนไข้ IPD(ครั้ง)'
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
                name: 'เดือน',
                colorByPoint: true,
                data:$js_data7
        }]
     });
    });
");
// จบ chart



// Chart8
$this->registerJs(" 
    $(function () {
    $('#chart8').highcharts({
        chart: {
            type: 'pie',
        },
         credits: {
            enabled: false
        },
        title: {
            text: '$report_name8'
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
                    format: '<b>{point.name}</b>: {point.y:.0f} รายงาน',
                }
            }
        },
        series: [{
                name: 'จำนวน',
                colorByPoint: true,
                data:$js_data8
        }]
     },  function(chart) { // on complete
        var total = $sum8;    
        chart.renderer.text('รวม: ' + total + ' รายงาน', 20, 105)
            .css({
                color: '#4572A7',
                fontSize: '16px'
            })
        .add();
        });
    });
");
// จบ chart8


?> 
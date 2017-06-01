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
    <div class="col-md-12">
        <div id="chart"></div>
    </div>
</div>

<br/>

  <div class="row">
    <div class="col-md-12">
        <div id="chart2"></div>
    </div>
</div>


<?php


$data2 = [];
for ($i = 0; $i < count($rawData2); $i++) {
    $data2[] = [
        'name' => $rawData2[$i]['pdx'],
        'y' => $rawData2[$i]['count_vn'] * 1,
    ];
}


$data3 = [];
for ($i = 0; $i < count($rawData3); $i++) {
    $data3[] = [
        'name' => $rawData3[$i]['pre_diagnosis'],
        'y' => $rawData3[$i]['count_vn'] * 1,
    ];
}


$js_data2 = json_encode($data2);
$js_data3 = json_encode($data3);


// chart
/*
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
            text: 'กราฟ 50 อันดับโรคที่ส่ง Refer ที่ IPD(แยกตามผลวินิจฉัยหลักจาก รพ.ต้นทาง)'
        },
        
         yAxis: {
            min: 0,
            title: {
                text: 'จำนวนครั้งการส่ง Refer (ครั้ง)'
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
                name: 'รหัสโรค',
                colorByPoint: true,
                data:$js_data2
        }]
     });
    });
");
// จบ chart

*/
?>


<br/>



<?php


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
            text: 'กราฟ 30 อันดับโรคที่ส่ง Refer ที่ IPD (แยกตามผลวินิจฉัยเบื้องต้นจาก รพ.ต้นทาง)'
        },
        
         yAxis: {
            min: 0,
            title: {
                text: 'จำนวนครั้งการส่ง Refer (ครั้ง)'
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
                name: 'รหัสโรค',
                colorByPoint: true,
                data:$js_data3
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
            'attribute' => 'department_name',
            'header' => 'ห้อง'
        ],
        [
            'attribute' => 'refer_date',
            'header' => 'ว/ด/ป ส่ง refer'
        ],
        [
            'attribute' => 'hn',
            'header' => 'HN'
        ],
        [
            'attribute' => 'ptname',
            'header' => 'ชื่อ-สกุล'
        ],
        [
            'attribute' => 'refer_number',
            'header' => 'เลขที่ Refer'
        ],
        [
            'attribute' => 'pre_diagnosis',
            'header' => 'วินิจฉัยโรคขั้นต้น'
        ],
        [
            'attribute' => 'pdx',
            'header' => 'การวินิจฉัยโรคหลัก'
        ],
        [
            'attribute' => 'refer_hospname',
            'header' => 'หน่วยปลายทาง'
        ],
        [
            'attribute' => 'doctor_name',
            'header' => 'แพทย์ผู้สั่ง'
        ],
        [
            'attribute' => 'refername',
            'header' => 'สาเหตุที่ส่งต่อ'
        ],
        [
            'attribute' => 'confirm_text',
            'header' => 'ผลการรักษา'
        ],
      
       
    ]
])
?>


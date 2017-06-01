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



<?php
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
$data2 = [];
for ($i = 0; $i < count($rawData2); $i++) {
    $data2[] = [
        'name' => $rawData2[$i]['plain_text'],
        'y' => $rawData2[$i]['count_hn'] * 1,
    ];
}

$js_data2 = json_encode($data2);


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
                name: 'ระดับ CVD',
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
            'attribute' => 'pt_name',
            'header' => 'ชื่อ-สกุล'
        ],
        [
            'attribute' => 'moopart',
            'header' => 'หมู่บ้าน',
        ],
        [
            'attribute' => 'address',
            'header' => 'ที่อยู่',
        ],
        
             [
            'attribute' => 'note_date',
            'header' => 'วันที่บันทึก',
        ],
         [
            'attribute' => 'plain_text',
            'header' => 'CVD Result',
        ],
      
      
        
    ]
])
?>


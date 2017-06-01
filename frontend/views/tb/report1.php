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
for ($i = 0; $i < count($rawData2); $i++) {
    $data[] = [
        'name' => $rawData2[$i]['clinic'],
        'y' => $rawData2[$i]['count_vn'] * 1,
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
                text: 'จำนวนการคัดกรอง(ครั้ง)'
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
                name: 'รายการหัตถการ',
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
            'attribute' => 'hn',
            'header' => 'HN'
        ],
        [
            'attribute' => 'entry_date',
            'header' => 'วันที่คัดกรอง'
        ],
         [
            'attribute' => 'clinic',
            'header' => 'คลินิก'
        ],
        [
            'attribute' => 'condition_1',
            'header' => 'อาการไอผิดปกติ(Any cough) > 2 wks'
        ],
        [
            'attribute' => 'condition_2',
            'header' => 'อาการไข้ภายใน 1 เดือน'
        ],
        [
            'attribute' => 'condition_3',
            'header' => 'น้ำหนักลดลงเกิน 5% ของน้ำหนักตัวภายใน 1 เดือน'
        ],
        [
            'attribute' => 'condition_4',
            'header' => 'เหงื่อออกมากผิดปกติตอนกลางคืน มากกว่า 3สัปดาห์ภายใน 1 เดือน'
        ],
        [
            'attribute' => 'condition_5',
            'header' => 'ต่อมน้ำเหลืองบริเวณคอโตมากกว่า 2 เซนติเมตร'
        ],
        [
            'attribute' => 'staff',
            'header' => 'คัดกรองโดย'
        ],        
    ]
])
?>


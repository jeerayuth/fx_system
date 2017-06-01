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
$data = [];
for ($i = 0; $i < count($rawData); $i++) {
    $data[] = [
        'name' => $rawData[$i]['dch_type'],
        'y' => $rawData[$i]['count_vn'] * 1,
    ];
}



$js_data = json_encode($data);


// chart
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
            text: 'รายงานจำนวนครั้งผู้รับบริการในกลุ่มผู้ป่วยกระดูกหัก (แบบ Close) ที่ห้องอุบัติเหตุฉุกเฉิน'
        },
        
         yAxis: {
            min: 0,
            title: {
                text: 'จำนวน (ครั้งรับบริการ)'
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
                name: 'สถานะภาพ',
                colorByPoint: true,
                data:$js_data
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
        'heading' => $report_name . " ระหว่างวันที่ $datestart ถึง $dateend",
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
            'attribute' => 'dch_type',
            'header' => 'สถานภาพ'
        ],
        [
            'attribute' => 'count_vn',
            'header' => 'จำนวนครั้งรับบริการ',
            'format' => 'raw',
            'value' => function($model) use ($datestart, $dateend, $report_name) {
                $er_dch_type = $model['er_dch_type'];
                $count_vn = $model['count_vn'];
                return Html::a(Html::encode($count_vn), ['emergen/report19', 'er_dch_type' => $er_dch_type, 'datestart' => $datestart, 'dateend' => $dateend, 'report_name' => $report_name], ['target' => '_blank']);
            }
                ]
            ]
        ])
        ?>



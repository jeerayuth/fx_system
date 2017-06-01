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
        'name' => $rawData[$i]['drug_name'],
        'y' => $rawData[$i]['sum_cost'] * 1,
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
                text: 'มูลค่าการใช้ตามราคาทุน (บาท)'
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
            'attribute' => 'icode',
            'header' => 'ICODE'
        ],
        [
            'attribute' => 'drug_name',
            'header' => 'ชื่อยา'
        ],
        [
            'attribute' => 'drug_unit',
            'header' => 'หน่วย'
        ],
        [
            'attribute' => 'unitprice',
            'header' => 'ราคาขาย(ล่าสุด)/หน่วย'
        ],
         [
            'attribute' => 'unitcost',
            'header' => 'ราคาทุน(ล่าสุด)/หน่วย'
        ],
        [
            'attribute' => 'count_icode',
            'header' => 'จำนวนครั้งที่สั่งใช้'
        ],
        [
            'attribute' => 'total_use',
            'header' => 'จำนวนรวมทั้งหมด'
        ],
        [
            'attribute' => 'sum_price',
            'header' => 'มูลค่าการใช้(ราคาขาย)'
        ],
         [
            'attribute' => 'sum_cost',
            'header' => 'มูลค่าการใช้(ราคาทุน)'
        ],
        
    ]
])
?>


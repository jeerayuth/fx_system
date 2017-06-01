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
        <div id="chart1"></div>
    </div>
</div>



<?php
if ($lab_item == 3248) {


    $sql_grap = " 
         
  SELECT

(
    SELECT CASE 
      WHEN (lo.lab_order_result >=90) THEN '1'
      WHEN (lo.lab_order_result >=60 AND lo.lab_order_result <=89.99) THEN '2'
      WHEN (lo.lab_order_result >=30 AND lo.lab_order_result <=59.99) THEN '3A'
      WHEN (lo.lab_order_result >=15 AND lo.lab_order_result <=29.99) THEN '4'
      ELSE '5' END
      
) AS lab_order_result_report , count(distinct(o.hn)) as count_hn

FROM ovst o

left outer join clinicmember c ON c.hn=o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id = c.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left outer join vn_stat v      ON v.vn = o.vn
left outer join thaiaddress t  on t.addressid = v.aid
left outer join patient p      ON p.hn = o.hn
left outer join lab_head lh    ON lh.vn = v.vn
left outer join lab_order lo   ON lo.lab_order_number = lh.lab_order_number
left outer join lab_items li   ON li.lab_items_code = lo.lab_items_code

WHERE lo.lab_items_code in ('3248') AND lo.confirm = 'Y'

AND o.vstdate BETWEEN   $datestart and $dateend
AND c.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND c.hn not in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code' )) 
AND lo.lab_order_result!='' AND lo.lab_order_result!='-' AND lo.lab_order_result!='.'
AND lo.lab_order_result  $operators   $result_first
    
GROUP  BY lab_order_result_report ";

    try {
        $rawData_grap = \yii::$app->db->createCommand($sql_grap)->queryAll();
    } catch (\yii\db\Exception $e) {
        throw new \yii\web\ConflictHttpException('sql error');
    }


    //เตรียมชุดข้อมูลไปใส่ให้กราฟ
    $data1 = [];
    $sum1 = 0;
    foreach ($rawData_grap as $r) {
        $data1[] = [
            'name' => $r['lab_order_result_report'],
            'y' => intval($r['count_hn']),
        ];
        $sum1 += $r['count_hn'];
    }

    $js_data_grap = json_encode($data1);



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
            text: '$report_name'
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
                data:$js_data_grap
        }]
     },  function(chart) { // on complete
        var total = $sum1;    
        chart.renderer.text('รวม: ' + total + ' คน', 20, 100)
            .css({
                color: '#4572A7',
                fontSize: '16px'
            })
        .add();
        });
    });
");
// จบ chart1


    echo "<br/>";

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
                'attribute' => 'age_y',
                'header' => 'อายุ'
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
                'attribute' => 'vstdate',
                'header' => 'วันที่รับบริการ',
            ],
            [
                'attribute' => 'lab_order_result',
                'header' => 'ผลแลป',
            ],
            [
                'attribute' => 'lab_order_result_report',
                'header' => 'ผลวิเคราะห์',
            ]
        ]
    ]);
} else {

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
                'attribute' => 'age_y',
                'header' => 'อายุ'
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
                'attribute' => 'vstdate',
                'header' => 'วันที่รับบริการ',
            ],
            [
                'attribute' => 'lab_order_result',
                'header' => 'ผลแลป',
            ]
        ]
    ]);
}
?>


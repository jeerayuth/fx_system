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
if ($uclinic != "") {
    // รายงานจำนวนคนไข้คลินิคเบาหวานที่ไม่มีความดันโลหิต CKD Diag (N181 - N185)
    if ($uclinic == 1) {
        $get_type = "not";
    } else if ($uclinic == 2) {
        //รายงานจำนวนคนไข้คลินิคเบาหวานที่มีความดันร่วม CKD Diag (N181 - N185)
        $get_type = "";
    }
}

$sql_grap = "select

'N181',count(distinct(o.hn)) as count_hn

from ovst  o

left outer join vn_stat v on v.vn = o.vn
left outer join patient pt on pt.hn = o.hn
left outer join clinicmember cm on cm.hn = o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left OUTER join thaiaddress t on t.addressid= v.aid
left outer join sex s on s.code = pt.sex

WHERE
  o.vstdate between $datestart and $dateend
AND 
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND
  cm.hn $get_type in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
(
          (v.dx0 = 'N181') OR
          (v.dx1 = 'N181') OR
          (v.dx2 = 'N181') OR
          (v.dx3 = 'N181') OR
          (v.dx4 = 'N181') OR
          (v.dx5 = 'N181')
 )

GROUP BY N181

UNION

select

'N182',count(distinct(o.hn)) as count_hn

from ovst  o

left outer join vn_stat v on v.vn = o.vn
left outer join patient pt on pt.hn = o.hn
left outer join clinicmember cm on cm.hn = o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left OUTER join thaiaddress t on t.addressid= v.aid
left outer join sex s on s.code = pt.sex

WHERE
  o.vstdate between $datestart and $dateend
AND 
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND
  cm.hn  $get_type  in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
(
          (v.dx0 = 'N182') OR
          (v.dx1 = 'N182') OR
          (v.dx2 = 'N182') OR
          (v.dx3 = 'N182') OR
          (v.dx4 = 'N182') OR
          (v.dx5 = 'N182')
 )

 
GROUP BY N182


UNION


select

'N183',count(distinct(o.hn)) as count_hn

from ovst  o

left outer join vn_stat v on v.vn = o.vn
left outer join patient pt on pt.hn = o.hn
left outer join clinicmember cm on cm.hn = o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left OUTER join thaiaddress t on t.addressid= v.aid
left outer join sex s on s.code = pt.sex

WHERE
  o.vstdate between $datestart and $dateend
AND 
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND
  cm.hn  $get_type  in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
(
          (v.dx0 = 'N183') OR
          (v.dx1 = 'N183') OR
          (v.dx2 = 'N183') OR
          (v.dx3 = 'N183') OR
          (v.dx4 = 'N183') OR
          (v.dx5 = 'N183')
 )


GROUP BY N183


UNION


select

'N184',count(distinct(o.hn)) as count_hn

from ovst  o

left outer join vn_stat v on v.vn = o.vn
left outer join patient pt on pt.hn = o.hn
left outer join clinicmember cm on cm.hn = o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left OUTER join thaiaddress t on t.addressid= v.aid
left outer join sex s on s.code = pt.sex

WHERE
  o.vstdate between $datestart and $dateend
AND 
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND
  cm.hn  $get_type  in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
(
          (v.dx0 = 'N184') OR
          (v.dx1 = 'N184') OR
          (v.dx2 = 'N184') OR
          (v.dx3 = 'N184') OR
          (v.dx4 = 'N184') OR
          (v.dx5 = 'N184')
 )


GROUP BY N184



UNION


select

'N185',count(distinct(o.hn)) as count_hn

from ovst  o

left outer join vn_stat v on v.vn = o.vn
left outer join patient pt on pt.hn = o.hn
left outer join clinicmember cm on cm.hn = o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left OUTER join thaiaddress t on t.addressid= v.aid
left outer join sex s on s.code = pt.sex

WHERE
  o.vstdate between $datestart and $dateend
AND 
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND
  cm.hn  $get_type  in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
(
          (v.dx0 = 'N185') OR
          (v.dx1 = 'N185') OR
          (v.dx2 = 'N185') OR
          (v.dx3 = 'N185') OR
          (v.dx4 = 'N185') OR
          (v.dx5 = 'N185')
 )


GROUP BY N185

 ";

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
        'name' => $r['N181'],
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
            'attribute' => 'pdx',
            'header' => 'PDX',
        ],
        [
            'attribute' => 'dx0',
            'header' => 'DX0',
        ],
        [
            'attribute' => 'dx1',
            'header' => 'DX1',
        ],
        [
            'attribute' => 'dx2',
            'header' => 'DX2',
        ],
        [
            'attribute' => 'dx3',
            'header' => 'DX3',
        ],
        [
            'attribute' => 'dx4',
            'header' => 'DX4',
        ],
        [
            'attribute' => 'dx5',
            'header' => 'DX5',
        ],
        
        [
            'attribute' => 'count_lab_gfr',
            'header' => 'จำนวนตรวจแลป egfr',
        ],
        
        [
            'attribute' => 'lab_gfr_last',
            'header' => 'แลป egfr ล่าสุด1',
        ],
        
         [
            'attribute' => 'lab_gfr_second_last',
            'header' => 'แลป egfr ล่าสุด2',
        ],
        
         [
            'attribute' => 'lab_gfr_third_last',
            'header' => 'แลป egfr ล่าสุด3',
        ],
        
         [
            'attribute' => 'lab_gfr_fourth_last',
            'header' => 'แลป egfr ล่าสุด4',
        ],
    ]
])
?>


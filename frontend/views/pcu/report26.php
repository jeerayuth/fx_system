<?php
/* @var $this yii\web\View */

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>



<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'heading' => $report_name,
        'before' => $details,
        'type' => 'primary',
        'after' => 'ประมวลผล ณ วันที่ ' . date('Y-m-d H:i:s') . '  หมายเหตุ <a href="http://192.168.1.252:8080/mis/frontend/web/index.php?r=pcu/report28" target="_blank">แก้ไขกรณีบ้านหลังนั้นๆไม่ได้ระบุ Location</a>'
    ],
    'export' => [
        'fontAwesome' => true,
        'showConfirmAlert' => false,
        'target' => GridView::TARGET_BLANK
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'village_moo',
            'header' => 'หมู่ที่'
        ],
        [
            'attribute' => 'village_name',
            'header' => 'ชื่อหมู่บ้าน'
        ],
         [
            'attribute' => 'location_area_name',
            'header' => 'Location'
        ],
               
        [
            'attribute' => 'count_location',
            'header' => 'จำนวน(คน)',
            'format' => 'raw',
            'value' => function($model) {
                $village_id = $model['village_id'];
                $location_area_id = $model['location_area_id'];
                $count_location = $model['count_location'];
                $age_id = $_GET['age_id'];
                return Html::a(Html::encode($count_location), ['pcu/report27', 'village_id' => $village_id,'age_id'=> $age_id,'location_area_id'=> $location_area_id]);
            }
                ]
        
            ]
        
            
            ])
        ?>



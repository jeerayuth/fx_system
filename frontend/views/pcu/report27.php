<?php

/* @var $this yii\web\View */

use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>



<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'heading' => $report_name,
        'before' => '',
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
            'attribute' => 'person_name',
            'header' => 'ชื่อ-สกุล'
        ],
        [
            'attribute' => 'village_moo',
            'header' => 'หมู่บ้าน'
        ],
        [
            'attribute' => 'village_name',
            'header' => 'ชื่อหมู่บ้าน'
        ],
        [
            'attribute' => 'address',
            'header' => 'เลขที่'
        ],
        [
            'attribute' => 'full_name',
            'header' => 'ที่อยู่'
        ],
          [
            'attribute' => 'location_area_name',
            'header' => 'Location'
        ],
        [
            'attribute' => 'age_y_cal',
            'header' => 'อายุ'
        ],
      
       
        
    ]
])
?>


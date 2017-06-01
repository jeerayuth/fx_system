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
        'heading' => $report_name .' ปีงบประมาณ '. $begin_year,
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
            'attribute' => 'cid',
            'header' => 'CID'
        ],
        [
            'attribute' => 'person_name',
            'header' => 'ชื่อ-สกุล'
        ],
        [
            'attribute' => 'age_y',
            'header' => 'อายุ'
        ],
        [
            'attribute' => 'sex',
            'header' => 'เพศ'
        ],
        [
            'attribute' => 'address',
            'header' => 'เลขที่อยู่'
        ],
        [
            'attribute' => 'village_moo',
            'header' => 'หมู่ที่'
        ],
        [
            'attribute' => 'village_name',
            'header' => 'ชื่อหมู่บ้าน'
        ],
        [
            'attribute' => 'bmi',
            'header' => 'ค่า BMI'
        ],
        [
            'attribute' => 'waist',
            'header' => 'รอบเอว'
        ],
        [
            'attribute' => 'bdg_year',
            'header' => 'ปีที่คัดกรอง'
        ],
       
                     
    ]
])
?>


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
            'attribute' => 'bmi',
            'header' => 'BMI',
        ],
        [
            'attribute' => 'vstdate',
            'header' => 'วันที่คัดกรอง',
        ],
        [
            'attribute' => 'smoking_type_name',
            'header' => 'คัดกรองสูบบุหรี่',
        ],
        [
            'attribute' => 'drinking_type_name',
            'header' => 'คัดกรองดื่มสุรา',
        ],
    ]
])
?>


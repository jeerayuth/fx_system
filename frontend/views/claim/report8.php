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
            'attribute' => 'cid',
            'header' => 'บัตรประชาชน'
        ],
        [
            'attribute' => 'hn',
            'header' => 'HN'
        ],
        [
            'attribute' => 'vst_date',
            'header' => 'รับบริการ'
        ],
        [
            'attribute' => 'patient_name',
            'header' => 'ชื่อ-สกุล'
        ],
        [
            'attribute' => 'Birth_date',
            'header' => 'วันเกิด'
        ],
        [
            'attribute' => 'icd10',
            'header' => 'การวินิจฉัยโรค(icd10)'
        ],
        [
            'attribute' => 'icd_name',
            'header' => 'ชื่อโรค'
        ],
        [
            'attribute' => 'ttcode',
            'header' => 'ซี่ฟัน'
        ],
        [
            'attribute' => 'tmcode_name',
            'header' => 'การรักษา'
        ],
        [
            'attribute' => 'doctor',
            'header' => 'แพทย์'
        ],
        [
            'attribute' => 'income',
            'header' => 'ค่าบริการ'
        ],
      
    ]
])
?>


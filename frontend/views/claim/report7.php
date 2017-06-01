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
            'attribute' => 'ptname',
            'header' => 'ชื่อ-สกุล'
        ],
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
            'attribute' => 'doctor_name',
            'header' => 'แพทย์'
        ],
        [
            'attribute' => 'licenseno',
            'header' => 'ทะเบียน'
        ],
        [
            'attribute' => 'pdx',
            'header' => 'diag1'
        ],
        [
            'attribute' => 'dx0',
            'header' => 'diag2'
        ],
        [
            'attribute' => 'dx1',
            'header' => 'diag3'
        ],
        [
            'attribute' => 'dx2',
            'header' => 'diag4'
        ],
        [
            'attribute' => 'dx3',
            'header' => 'diag5'
        ],
        [
            'attribute' => 'dx4',
            'header' => 'diag6'
        ],
        [
            'attribute' => 'dx5',
            'header' => 'diag7'
        ],
        [
            'attribute' => 'inc12',
            'header' => 'ค่ายา'
        ],
        [
            'attribute' => 'other_income',
            'header' => 'ค่าบริการ'
        ],
        [
            'attribute' => 'inc01',
            'header' => 'ค่าอื่นๆ'
        ],
        [
            'attribute' => 'income',
            'header' => 'รวม'
        ],
    ]
])
?>


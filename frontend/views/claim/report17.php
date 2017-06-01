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
            'attribute' => 'sex',
            'header' => 'เพศ'
        ],
        [
            'attribute' => 'age_y',
            'header' => 'อายุ(ปี)'
        ],
        [
            'attribute' => 'icd10',
            'header' => 'การวินิจฉัย(ICD10)'
        ],
        [
            'attribute' => 'icd9',
            'header' => 'หัตถการ(ICD9)'
        ],
        [
            'attribute' => 'doc_name',
            'header' => 'แพทย์'
        ],
        [
            'attribute' => 'licenseno',
            'header' => 'ทะเบียน'
        ],
        [
            'attribute' => 'item_money',
            'header' => 'ค่าบริการ(บาท)'
        ],
      
    ]
])
?>


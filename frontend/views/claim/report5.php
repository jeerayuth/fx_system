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
            'attribute' => 'an',
            'header' => 'AN'
        ],
          [
            'attribute' => 'regdate',
            'header' => 'วันที่ลงทะเบียน'
        ],
        
        [
            'attribute' => 'dchdate',
            'header' => 'วันที่จำหน่าย'
        ],
        [
            'attribute' => 'patient_name',
            'header' => 'ชื่อ-สกุล'
        ],
        [
            'attribute' => 'age_y',
            'header' => 'อายุ(ปี)'
        ],
        [
            'attribute' => 'icd10',
            'header' => 'การวินิจฉัยโรค(ICD10)'
        ],
        [
            'attribute' => 'icd9',
            'header' => 'หัตถการ(ICD9)'
        ],
        [
            'attribute' => 'item_money',
            'header' => 'ค่าบริการ'
        ],
        [
            'attribute' => 'rw',
            'header' => 'Adj RW'
        ],
       
      
       
          
    ]
])
?>


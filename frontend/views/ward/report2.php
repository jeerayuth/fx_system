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
            'attribute' => 'ptname',
            'header' => 'ชื่อ-สกุล'
        ],
         [
            'attribute' => 'AN_new',
            'header' => 'AN ใหม่'
        ],
         [
            'attribute' => 'regdate_AN_New',
            'header' => 'วันรับใหม่'
        ],
         [
            'attribute' => 'dcdate_AN_New',
            'header' => 'วัน Discharge ใหม่'
        ],
         [
            'attribute' => 'AN_old',
            'header' => 'AN เก่า'
        ],
         [
            'attribute' => 'regdate_AN_Old',
            'header' => 'วันรับเก่า'
        ],
         [
            'attribute' => 'dcdate_AN_Old',
            'header' => 'วัน Discharge เก่า'
        ],
         [
            'attribute' => 'icd10_1',
            'header' => 'icd10'
        ],
         [
            'attribute' => 'ReAdmitDate',
            'header' => 'วัน re-admit'
        ],
       
          
    ]
])
?>


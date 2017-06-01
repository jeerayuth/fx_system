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
            'header' => 'เลขบัตรประชาชน'
        ],
        [
            'attribute' => 'hn',
            'header' => 'HN'
        ],
        [
            'attribute' => 'pt_name',
            'header' => 'ชื่อ-สกุล'
        ],
        [
            'attribute' => 'addrpart',
            'header' => 'บ้านเลขที่'
        ],
        [
            'attribute' => 'moopart',
            'header' => 'หมู่ที่'
        ],
        [
            'attribute' => 'full_name',
            'header' => 'ที่อยู่'
        ],
        [
            'attribute' => 'hometel',
            'header' => 'เบอร์โทรติดต่อ'
        ],
        [
            'attribute' => 'house_regist_type_id',
            'header' => 'Typearea(ฝั่งPerson)'
        ],
        [
            'attribute' => 'count_vn_59',
            'header' => 'จำนวนครั้งรับบริการ(ปี59)'
        ],
        [
            'attribute' => 'count_vn_58',
            'header' => 'จำนวนครั้งรับบริการ(ปี58)'
        ]
      
    ]
])
?>


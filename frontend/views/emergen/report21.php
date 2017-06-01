<?php

/* @var $this yii\web\View */

use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>

<?php

if ($er_dch_type == 2) {

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'heading' => $report_name,
            'before' => ' ',
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
                'attribute' => 'vstdate_thai',
                'header' => 'วันที่รับบริการ'
            ],
            [
                'attribute' => 'pdx',
                'header' => 'รหัสวินิจฉัยหลัก'
            ],
            [
                'attribute' => 'dx0',
                'header' => 'รหัสวินิจฉัยรอง 1'
            ],
            [
                'attribute' => 'dx1',
                'header' => 'รหัสวินิจฉัยรอง 2'
            ],
            [
                'attribute' => 'dx2',
                'header' => 'รหัสวินิจฉัยรอง 3'
            ], [
                'attribute' => 'dx3',
                'header' => 'รหัสวินิจฉัยรอง 4'
            ],
            [
                'attribute' => 'dx4',
                'header' => 'รหัสวินิจฉัยรอง 5'
            ],
            [
                'attribute' => 'dx5',
                'header' => 'รหัสวินิจฉัยรอง 6'
            ],
            [
                'attribute' => 'hosp_name',
                'header' => 'ส่งต่อไปที่'
            ],
        ]
    ]);
} else {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'heading' => $report_name,
            'before' => ' ',
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
                'attribute' => 'vstdate_thai',
                'header' => 'วันที่รับบริการ'
            ],
            [
                'attribute' => 'pdx',
                'header' => 'รหัสวินิจฉัยหลัก'
            ],
            [
                'attribute' => 'dx0',
                'header' => 'รหัสวินิจฉัยรอง 1'
            ],
            [
                'attribute' => 'dx1',
                'header' => 'รหัสวินิจฉัยรอง 2'
            ],
            [
                'attribute' => 'dx2',
                'header' => 'รหัสวินิจฉัยรอง 3'
            ], [
                'attribute' => 'dx3',
                'header' => 'รหัสวินิจฉัยรอง 4'
            ],
            [
                'attribute' => 'dx4',
                'header' => 'รหัสวินิจฉัยรอง 5'
            ],
            [
                'attribute' => 'dx5',
                'header' => 'รหัสวินิจฉัยรอง 6'
            ],
        ]
    ]);
}






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
            'attribute' => 'vstdate',
            'header' => 'วันที่'
        ],
        [
            'attribute' => 'count_all_visit',
            'header' => 'จำนวน visit'
        ],
        [
            'attribute' => 'count_j00',
            'header' => 'j00'
        ],
       
          [
            'attribute' => 'count_j020_j029',
            'header' => 'j020-j029'
        ],
         [
            'attribute' => 'count_j060_j069',
            'header' => 'j060-j069'
        ],
         [
            'attribute' => 'count_j09',
            'header' => 'j09'
        ],
         [
            'attribute' => 'count_j10',
            'header' => 'j10'
        ],
         [
            'attribute' => 'count_j11',
            'header' => 'j11'
        ],
                     
    ]
])
?>


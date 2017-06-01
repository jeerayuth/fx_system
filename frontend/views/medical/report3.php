<?php

/* @var $this yii\web\View */
use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>


<div style="display:none">
    <?php
    echo Highcharts::widget([
        'scripts' => [
            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
            'themes/grid'        // applies global 'grid' theme to all charts
        ],
    ]);
    ?>  
</div>


<div id="chart"></div>



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
            'attribute' => 'cid',
            'header' => 'CID'
        ],
        [
            'attribute' => 'ptname',
            'header' => 'ชื่อ-สกุล'
        ],
        [
            'attribute' => 'deathday',
            'header' => 'วันที่เสียชีวิต'
        ],

        [
            'attribute' => 'death_diag_a',
            'header' => 'Diag(a)'
        ],
         [
            'attribute' => 'death_diag_b',
            'header' => 'Diag(b)'
        ],
         [
            'attribute' => 'death_diag_c',
            'header' => 'Diag(c)'
        ],
         [
            'attribute' => 'death_diag_d',
            'header' => 'Diag(d)'
        ],
          
    ]
])
?>


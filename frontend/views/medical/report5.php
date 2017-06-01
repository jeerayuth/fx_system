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
            'attribute' => 'vstdate',
            'header' => 'วันที่รับบริการ'
        ],
        [
            'attribute' => 'count_all_visit',
            'header' => 'จำนวนการรับบริการ(ครั้ง)'
        ],
        [
            'attribute' => 'count_folder_complete',
            'header' => 'ได้รับ opd card (ทั้งหมด)'
        ],
        [
            'attribute' => 'count_in_time',
            'header' => 'ได้รับ opd card (ในเวลา)'
        ],
        [
            'attribute' => 'difference_date_receive',
            'header' => 'ได้รับ opd card (คนละวัน)'
        ],
         [
            'attribute' => 'count_rw_o',
            'header' => 'RW เป็น 0'
        ],
         [
            'attribute' => 'count_pdx_empty',
            'header' => 'No Diag'
        ],


        
          
    ]
])
?>


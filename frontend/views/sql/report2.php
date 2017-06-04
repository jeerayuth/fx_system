<?php

/* @var $this yii\web\View */
use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
HighchartsAsset::register($this)->withScripts([
	'highcharts-more',
	'themes/grid'
]);


$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>


<div id="container"></div>

<?php

echo Highcharts::widget([
   'options' => [
      'title' => ['text' => 'Fruit Consumption'],
      'xAxis' => [
         'categories' => ['Apples', 'Bananas', 'Oranges']
      ],
      'yAxis' => [
         'title' => ['text' => 'Fruit eaten']
      ],
      'series' => [
         ['name' => 'Jane', 'data' => [1, 0, 4]],
         ['name' => 'John', 'data' => [5, 7, 3]]
      ]
   ]
]);
?>



<br/>


<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'heading' => $report_name,
        'before' => "",
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
            'attribute' => 'month_s',
            'header' => 'เดือน'
        ],
        [
            'attribute' => 'open',
            'header' => 'OPEN'
        ],
        [
            'attribute' => 'hight',
            'header' => 'HIGHT'
        ],
        [
            'attribute' => 'low',
            'header' => 'LOW'
        ],
        [
            'attribute' => 'close',
            'header' => 'CLOSE'
        ],
          [
            'attribute' => 'oh',
            'header' => 'OH',
              'format' => ['decimal',0] 
        ],
        [
            'attribute' => 'ol',
            'header' => 'OL',
             'format' => ['decimal',0] 
        ],
       
          
    ]
])
?>

<button type="button" class="btn btn-success" onclick = "javascript:(history.go(-1))"><i class="glyphicon glyphicon-menu-left"></i> ย้อนกลับ</button>

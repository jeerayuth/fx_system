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
        'before' => "",
        'type' => 'primary',
        'after' => 'ประมวลผล ณ วันที่ ' . date('Y-m-d H:i:s')
    ],
    'floatHeader' => true,
    'export' => [
        'fontAwesome' => true,
        'showConfirmAlert' => false,
        'target' => GridView::TARGET_BLANK
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
           
        [
            'attribute' => 'year_s',
            'header' => 'ปี',
            'format' => 'raw',
            'value' => function($model) {
                $sub_currency_id = $_GET['sub_currency_id'];
                $year_s = $model['year_s'];
                return Html::a(Html::encode($year_s), ['sql/report2','year_s'=>$year_s,'sub_currency_id'=> $sub_currency_id]);
            }
                ]
       
          
    ]
])
?>



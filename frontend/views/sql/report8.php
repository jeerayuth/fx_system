<?php

/* @var $this yii\web\View */
use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use yii\web\JsExpression;
HighchartsAsset::register($this)->withScripts([
	'highcharts-more',
	'themes/grid'
]);


$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>


<div id="chart"></div>

<?php

//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y

//เตรียมชุดข้อมูลวันที่
$text_data_s = array();
$data_s = [];


//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
for ($i = 0; $i < count($rawData); $i++) {
    $text_data_s = $rawData[$i]['cal_price_range']*1;
    array_push($data_s, $text_data_s);   
}
//print_r($data_date_s);
$js_data_s = json_encode($data_s);


echo $js_data_s;


// chart
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'Combination chart',
        ],
       
        'labels' => [
            'items' => [
                [
                    'html' => 'Total fruit consumption',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
       
        'series' => [         
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => $js_data_s,
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[3]'),
                    'fillColor' => 'white',
                ],

                'center' => [100, 80],
                'size' => 100,
                'showInLegend' => false,
                'dataLabels' => [
                    'enabled' => false,
                ],
            ],
        ],
    ]
]);


?>



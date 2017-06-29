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


$this->title = 'test';
//$this->params['breadcrumbs'][] = $this->title;
?>


<div id="chart"></div>

<?php

//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y

$categ = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $categ[] = $rawData[$i]['date_s'];
        }
        $js_categ = implode("','", $categ);

        
        $data1 = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $data1[] = intval($rawData[$i]['price_range_1']);
        }
                     
        $data2 = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $data2[] = intval($rawData[$i]['price_range_2']);
        }
        
        $js_data1 = implode(",", $data1);
        $js_data2 = implode(",", $data2);



        $this->registerJs(" $(function () {
                            $('#chart').highcharts({
                                title: {
                                    text: 'test1',
                                    x: -20 //center
                                },
                                chart: {
                                       height: 550
                                },
                                subtitle: {
                                    text: '',
                                    x: -20
                                },
                                xAxis: {
                                      categories: ['$js_categ'],
                                },
                                yAxis: {
                                    title: {
                                        text: 'ระยะการแกว่ง'
                                    },
                                    plotLines: [{
                                        value: 0,
                                        width: 1,
                                        color: '#808080'
                                    }]
                                },
                                tooltip: {
                                    valueSuffix: ''
                                },
                                legend: {
                                    layout: 'vertical',
                                    align: 'right',
                                    verticalAlign: 'middle',
                                    borderWidth: 0
                                },
                                credits: {
                                    enabled: false
                                },
                                series: [{
                                    name: 'คู่เงินที่ 1',
                                    data: [$js_data1]
                                }, {
                                    name: 'คู่เงินที่ 2',
                                    data: [$js_data2]
                                }]
                            });
                        });
             ");
        ?>



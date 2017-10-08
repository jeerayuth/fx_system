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

$categ = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $categ[] = $rawData[$i]['date_s'];
        }
        $js_categ = implode("','", $categ);

        
        $data = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $data[] = intval($rawData[$i]['cal_price_range']);
        }
        
        $data2 = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $data2[] = intval($rawData[$i]['cal_price_range_inverse']);
        }
        
        $data3 = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $data3[] = intval($rawData[$i]['cal_price_range_hight']);
        }
        
        $data4 = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $data4[] = intval($rawData[$i]['cal_price_range_low']);
        }
           
        
        $js_data = implode(",", $data);
        $js_data2 = implode(",", $data2);
        $js_data3 = implode(",", $data3);
        $js_data4 = implode(",", $data4);


        

        $this->registerJs(" $(function () {
                            $('#chart').highcharts({
                                title: {
                                    text: '$report_name',
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
                                    name: 'hight',
                                    data: [$js_data3]
                                },{
                                    name: 'open',
                                    data: [$js_data]
                                },{
                                    name: 'low',
                                    data: [$js_data4]
                                }]
                            });
                        });
             "); 
        ?>



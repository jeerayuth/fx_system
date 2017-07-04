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
        for ($i = 0; $i < count($rawData1); $i++) {
            $categ[] = $rawData1[$i]['date_s'];
        }
        $js_categ = implode("','", $categ);

        
        $data1 = [];
        for ($i = 0; $i < count($rawData1); $i++) {
            $data1[] = intval($rawData1[$i]['price_range_1']);
        }
  
        
        $data2 = [];
        for ($i = 0; $i < count($rawData2); $i++) {
            $data2[] = intval($rawData2[$i]['price_range_2']);
        }
        
        $data3 = [];
        for ($i = 0; $i < count($rawData3); $i++) {
            $data3[] = intval($rawData3[$i]['price_range_3']);
        }
        
        $data4 = [];
        for ($i = 0; $i < count($rawData4); $i++) {
            $data4[] = intval($rawData4[$i]['price_range_4']);
        }
        
        $data5 = [];
        for ($i = 0; $i < count($rawData5); $i++) {
            $data5[] = intval($rawData5[$i]['price_range_5']);
        }
        
        $data6 = [];
        for ($i = 0; $i < count($rawData6); $i++) {
            $data6[] = intval($rawData6[$i]['price_range_6']);
        }
        
        $data7 = [];
        for ($i = 0; $i < count($rawData7); $i++) {
            $data7[] = intval($rawData7[$i]['price_range_7']);
        }
        
        $data8 = [];
        for ($i = 0; $i < count($rawData8); $i++) {
            $data8[] = intval($rawData8[$i]['price_range_8']);
        }
        
        $js_data1 = implode(",", $data1);
        $js_data2 = implode(",", $data2);
        $js_data3 = implode(",", $data3);
        $js_data4 = implode(",", $data4);
        $js_data5 = implode(",", $data5);
        $js_data6 = implode(",", $data6);
        $js_data7 = implode(",", $data7);
        $js_data8 = implode(",", $data8);
        

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
                                    name: '$sub_currency1',
                                    data: [$js_data1]
                                }, {
                                    name: '$sub_currency2',
                                    data: [$js_data2]
                                },  {
                                    name: '$sub_currency3',
                                    data: [$js_data3]
                                },  {
                                    name: '$sub_currency4',
                                    data: [$js_data4]
                                },  {
                                    name: '$sub_currency5',
                                    data: [$js_data5]
                                },  {
                                    name: '$sub_currency6',
                                    data: [$js_data6]
                                },  {
                                    name: '$sub_currency7',
                                    data: [$js_data7]
                                },  {
                                    name: '$sub_currency8',
                                    data: [$js_data8]
                                }]
                            });
                        });
             ");

?>



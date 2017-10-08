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


//$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>

<div id="chart2"></div>

<br/>

<div id="chart"></div>

<?php

//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
    // ชุดที่ 1 เอาไว้หาค่า min,max ของราคา ตามคาบเวลาที่เลือก
        $categ = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $categ[] = $rawData[$i]['date_s'];
        }
        $js_categ = implode("','", $categ);

       $data1 = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $data1[] = [
                'name' => $rawData[$i]['date_s'],
                'y' => $rawData[$i]['oh'] * 1,
            ];
        }

        $data2 = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $data2[] = [
                'name' => $rawData[$i]['date_s'],
                'y' => $rawData[$i]['ol'] * 1,
            ];
        }
        
        $js_data1 = json_encode($data1);
        $js_data2   = json_encode($data2);
        
        
     
        
        // chart
        $this->registerJs(" 
            Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },
            tooltip: {
                pointFormat: 'Value: {point.y:,.0f} Point'
            }, 
            title: {
                text: '$report_name'
            },
            xAxis: {
                categories: ['$js_categ'],
            },
            yAxis: {
                    tickInterval: 5
                },
            credits: {
                enabled: false
            },
            series: [{
                name: 'แกนบวก',
                data: $js_data1
            }, {
                name: 'แกนลบ',
                data: $js_data2
            }
            ]
        });
        ");
        // จบ chart
        
        
        
        
        
        // ชุดที่ 2 เอาไว้แสดงพฤติกรรมราคา
        
        $categ2 = [];
        for ($i = 0; $i < count($rawData2); $i++) {
            $categ2[] = $rawData2[$i]['date_s'];
        }
        $js_categ22 = implode("','", $categ2);

        
        $data2 = [];
        for ($i = 0; $i < count($rawData2); $i++) {
            $data2[] = intval($rawData2[$i]['cal_price_range']);
        }
        
        $data22 = [];
        for ($i = 0; $i < count($rawData2); $i++) {
            $data22[] = intval($rawData2[$i]['cal_price_range_inverse']);
        }
        
        $data33 = [];
        for ($i = 0; $i < count($rawData2); $i++) {
            $data33[] = intval($rawData2[$i]['cal_price_range_hight']);
        }
        
        $data44 = [];
        for ($i = 0; $i < count($rawData2); $i++) {
            $data44[] = intval($rawData2[$i]['cal_price_range_low']);
        }
               
        
        $js_data2 = implode(",", $data2);
        $js_data22 = implode(",", $data22);
        $js_data33 = implode(",", $data33);
        $js_data44 = implode(",", $data44);

     
        
            //เอาไว้แสดงค่า max,min ของราคา ในแต่ละชั่วโมง
        
        $data55 = [];
        for ($i = 0; $i < count($rawData2); $i++) {         
             $data55[] = intval($rawData2[$i]['oh']); 
        }
        
        $data66 = [];
        for ($i = 0; $i < count($rawData2); $i++) {         
             $data66[] = intval($rawData2[$i]['ol']); 
        }


        //convert array to json string;
        $js_data_hight = json_encode($data55);
        $js_data_low = json_encode($data66);

        
        $this->registerJs(" $(function () {
                            $('#chart2').highcharts({
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
                                      categories: ['$js_categ22'],
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
                                    data: [$js_data33]
                                },{
                                    name: 'open',
                                    data: [$js_data2]
                                },{
                                    name: 'low',
                                    data: [$js_data44]
                                },{
                                    type: 'column',
                                    name: 'แดนบวก',
                                    data: $js_data_hight

                                }, {
                                    type: 'column',
                                    name: 'แดนลบ',
                                    data: $js_data_low
                                    }],
                         
                            });
                        });
             "); 
        
        
        
        
        
        
        
        
        

            /* Chart แบบ Point   
        $this->registerJs(" $(function () {
                            $('#chart').highcharts({
                               chart: {
                                    type: 'scatter',
                                    zoomType: 'xy'
                                },
                                title: {
                                    text: '$report_name'
                                },

                                subtitle: {
                                    text: ''
                                },
                                xAxis: {
                                    title: {
                                        enabled: true,
                                        text: 'ระดับราคา'
                                    },
                                    startOnTick: true,
                                    endOnTick: true,
                                    showLastLabel: true
                                },
                                yAxis: {
                                    title: {
                                        text: 'ไม่ระบุ'
                                    }
                                },
                                legend: {
                                    layout: 'vertical',
                                    align: 'left',
                                    verticalAlign: 'top',
                                    x: 100,
                                    y: 70,
                                    floating: true,
                                    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
                                    borderWidth: 1
                                },
                                plotOptions: {
                                    scatter: {
                                        marker: {
                                            radius: 5,
                                            states: {
                                                hover: {
                                                    enabled: true,
                                                    lineColor: 'rgb(100,100,100)'
                                                }
                                            }
                                        },
                                        states: {
                                            hover: {
                                                marker: {
                                                    enabled: false
                                                }
                                            }
                                        },
                                        tooltip: {
                                            headerFormat: '<b>{series.name}</b><br>',
                                            pointFormat: '{point.x} จุด'
                                        }
                                    }
                                },
                                series: [{
                                    name: 'แดนบวก',
                                    color: 'rgba(223, 83, 83, .5)',
                                    data: $js_data_hight

                                }, {
                                    name: 'แดนลบ',
                                    color: 'rgba(119, 152, 191, .5)',
                                    data: $js_data_low
                                    }]
                                });
                            });
             "); 
             
             */
        ?>



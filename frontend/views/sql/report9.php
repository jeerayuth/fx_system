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


<div id="chart"></div>

<?php

//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
       $data1 = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $data1[] = [
                '0' => intval($rawData[$i]['open_to_hight']) * 1,
                '1' => 0,
            ];
        }
        
           $data2 = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $data2[] = [
                '0' => intval($rawData[$i]['open_to_low']) * 1,
                '1' => 0,
            ];
        }

        
        $js_data_hight = json_encode($data1);
        $js_data_low   = json_encode($data2);
        

              
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
        ?>



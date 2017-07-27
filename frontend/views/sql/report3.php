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


<div id="chart" style="min-width: 310px; height: 500px; margin: 0 auto"></div>

<?php

//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
/*
$data1 = [];
for ($i = 0; $i < count($rawData); $i++) {   
    $data1[] = [
        '0' => intval($rawData[$i]['oh']) * 1,
        '1' => 0,
    ];
}
$data2 = [];
for ($i = 0; $i < count($rawData); $i++) {
    $data2[] = [
        '0' => intval($rawData[$i]['ol']) * 1,
        '1' => 0,
    ];
}


//convert array to json string;
$js_data_hight = json_encode($data1);
$js_data_low = json_encode($data2);


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

//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y

$categ = [];
for ($i = 0; $i < count($rawData); $i++) {
    $categ[] = $rawData[$i]['month_s'];
}
$js_categ = implode("','", $categ);

        

$data1 = [];
for ($i = 0; $i < count($rawData); $i++) {
    $data1[] = [
        'name' => $rawData[$i]['month_s'],
        'y' => $rawData[$i]['oh'] * 1,
    ];
}

$data2 = [];
for ($i = 0; $i < count($rawData); $i++) {
    $data2[] = [
        'name' => $rawData[$i]['month_s'],
        'y' => $rawData[$i]['ol'] * 1,
    ];
}

$data3 = [];
for ($i = 0; $i < count($rawData2); $i++) {
    $data3[] = [
        'name' => $rawData2[$i]['date_s'],
        'y' => $rawData2[$i]['ol'] * 1,
    ];
}

$js_data1 = json_encode($data1);
$js_data2 = json_encode($data2);

$js_data3 = json_encode($data3);


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
    }, {
        type: 'spline',
        name: 'แกนบวก ปี..',
        data: $js_data3,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }]
});
");
// จบ chart
?>



<br/>
<center>
<button type="button" class="btn btn-primary" onclick = "javascript:(history.go(-1))"><i class="glyphicon glyphicon-menu-left"></i> ย้อนกลับ</button>
<a href="index.php?r=sql/report4&sub_currency_id=<?php echo  $sub_currency_id; ?>&year_s=<?php echo $year_s;?>" class="btn btn-danger"><i class="glyphicon glyphicon-menu-right"></i> ข้อมูลรายวัน</a>
</center>
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
            'attribute' => 'date_s',
            'header' => 'วันีที่'
        ],
        [
            'attribute' => 'month_s',
            'header' => 'เดือน'
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


<?php
/* @var $this yii\web\View */
use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use miloschuman\highcharts\Highstock;
use yii\web\JsExpression;
use kartik\datecontrol\Module;
use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;
use kartik\time\TimePicker;
\conquer\momentjs\MomentjsAsset::register($this);
HighchartsAsset::register($this)->withScripts([
	'highcharts-more',
	'themes/grid'
]);
$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div id="chart"></div>
    </div>
</div>


<?php
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y

$categ = [];
for ($i = 0; $i < count($rawData); $i++) {
    $categ[] = $rawData[$i]['month_s'];
}
$js_categ = implode("','", $categ);

//วันจันทร์
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

//วันอังคาร
$data3 = [];
for ($i = 0; $i < count($rawData2); $i++) {
    $data3[] = [
        'name' => $rawData2[$i]['date_s'],
        'y' => $rawData2[$i]['oh'] * 1,
    ];
}

$data4 = [];
for ($i = 0; $i < count($rawData2); $i++) {
    $data4[] = [
        'name' => $rawData2[$i]['date_s'],
        'y' => $rawData2[$i]['ol'] * 1,
    ];
}

//วันพุธ
$data5 = [];
for ($i = 0; $i < count($rawData3); $i++) {
    $data5[] = [
        'name' => $rawData3[$i]['date_s'],
        'y' => $rawData3[$i]['oh'] * 1,
    ];
}

$data6 = [];
for ($i = 0; $i < count($rawData3); $i++) {
    $data6[] = [
        'name' => $rawData3[$i]['date_s'],
        'y' => $rawData3[$i]['ol'] * 1,
    ];
}


//วันพฤหัสบดี
$data7 = [];
for ($i = 0; $i < count($rawData4); $i++) {
    $data7[] = [
        'name' => $rawData4[$i]['date_s'],
        'y' => $rawData4[$i]['oh'] * 1,
    ];
}

$data8 = [];
for ($i = 0; $i < count($rawData4); $i++) {
    $data8[] = [
        'name' => $rawData4[$i]['date_s'],
        'y' => $rawData4[$i]['ol'] * 1,
    ];
}


//วันศุกร์
$data9 = [];
for ($i = 0; $i < count($rawData5); $i++) {
    $data9[] = [
        'name' => $rawData5[$i]['date_s'],
        'y' => $rawData5[$i]['oh'] * 1,
    ];
}

$data10 = [];
for ($i = 0; $i < count($rawData5); $i++) {
    $data10[] = [
        'name' => $rawData5[$i]['date_s'],
        'y' => $rawData5[$i]['ol'] * 1,
    ];
}


//convert array to json string;
$js_data1 = json_encode($data1);
$js_data2 = json_encode($data2);
$js_data3 = json_encode($data3);
$js_data4 = json_encode($data4);
$js_data5 = json_encode($data5);
$js_data6 = json_encode($data6);
$js_data7 = json_encode($data7);
$js_data8 = json_encode($data8);
$js_data9 = json_encode($data9);
$js_data10 = json_encode($data10);


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
        type: 'spline',
        name: 'แกนบวกวันจันทร์ปี $year_s',
        data: $js_data1,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนลบวันจันทร์ปี $year_s',
        data: $js_data2,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนบวกวันอังคารปี $year_s',
        data: $js_data3,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนลบวันอังคารปี $year_s',
        data: $js_data4,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนบวกวันพุธปี $year_s',
        data: $js_data5,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนลบวันพุธปี $year_s',
        data: $js_data6,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนบวกวันพฤหัสบดีปี $year_s',
        data: $js_data7,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนลบวันพฤหัสบดีปี $year_s',
        data: $js_data8,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนบวกวันศุกร์ปี $year_s',
        data: $js_data9,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'white'
        }
    }, {
        type: 'spline',
        name: 'แกนลบวันศุกร์ปี $year_s',
        data: $js_data10,
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

<div class="row">
    <div class="col-md-6">
       
        <button type="button" class="btn btn-success" onclick = "javascript:(history.go(-1))"><i class="glyphicon glyphicon-menu-left"></i> ย้อนกลับ</button>
  <!--      <a href="index.php?r=sql/report5&sub_currency_id=<?php //echo  $sub_currency_id; ?>&year_s=<?php //echo $year_s;?>" class="btn btn-danger" target="_blank"><i class="glyphicon glyphicon-menu-right"></i> ระดับราคาเฉลี่ยราย 4 ชั่วโมง</a>  -->
       
    </div>
    <div class="col-md-6">
                 <form novalidate="" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left">
                   <div class="form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-6" for="first-name">เลือกช่วงวันที่ <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <?php
                            echo DatePicker::widget([
                                'name' => 'from_date',
                                'type' => DatePicker::TYPE_RANGE,
                                'name2' => 'to_date',
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-mm-yyyy'
                                ]
                            ]);
                            ?>
                            
                            <label class="radio-inline"><input type="radio" name="opttimeframe" value="_h1" checked>1 ชม.</label>
                            <label class="radio-inline"><input type="radio" name="opttimeframe" value="_m15">15 นาที</label>
                            <label class="radio-inline"><input type="radio" name="opttimeframe" value="_m5">5 นาที</label>
                            
                                                        
                            <button type="button" class="btn btn-info btn-block" onclick = "javascript:url()"><i class="fa fa-search"></i>ดูพฤติกรรมกราฟในรอบวัน</button> 
                            <button type="button" class="btn btn-info btn-block" onclick = "javascript:url_week()"><i class="fa fa-search"></i>ดูพฤติกรรมกราฟในรอบสัปดาห์</button>
                            <button type="button" class="btn btn-info btn-block" onclick = "javascript:url_volatility()"><i class="fa fa-search"></i>ดู Volatility กราฟในกรอบชั่วโมง</button>
                            
                                <?php
                            
                                echo '<label class="control-label">เวลาเริ่มต้น</label>';
                                echo TimePicker::widget(
                                        [
                                            'name' => 'begin_time',
                                            'value' =>  '01:00', // Default set is AM
                                            
                                        ]); 
                            ?>
                            <?php
                                
                                echo '<label class="control-label">เวลาสิ้นสุด</label>';
                                echo TimePicker::widget([
                                            'name' => 'end_time',
                                            'value' => '11:55 PM',
                                        ]);
                                 
                            ?>
                            
                            <button type="button" class="btn btn-danger btn-block" onclick = "javascript:url_price_range()"><i class="fa fa-search"></i>ดูระยะในกรอบเวลาในรอบวัน</button> 
                               
                        <!--    <button type="button" class="btn btn-primary" onclick = "javascript:url_5m()"><i class="fa fa-search"></i>ดูพฤติกรรมกราฟราย 5 นาที</button> -->
                        </div>
                       
                    </div>
                </form>
    </div>
</div>


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
            'header' => 'วันที่'
        ],
      [
            'attribute' => 'cur_name',
            'header' => 'คู่เงิน'
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



<script type="text/javascript">
    //function เรียกหน้ารายงาน
    function url() {
        
        //ตัดเครื่องหมาย - ออก แล้วส่ง datestart&dateend ไปยัง url ที่ต้องการ
         //ตัดเครื่องหมาย - ออก แล้วส่ง datestart&dateend ไปยัง url ที่ต้องการ
        d1 = $('#w0').val();
        var arr1 = d1.split("-");
        s1 = arr1[0];
        s2 = arr1[1];
        s3 = arr1[2];
        datestart = s3+s2+s1;
        d2 = $('#w0-2').val();
        var arr2 = d2.split("-");
        m1 = arr2[0];
        m2 = arr2[1];
        m3 = arr2[2];
        dateend = m3+m2+m1;
        
        timeframe = $("[name='opttimeframe']:checked").val()
        
        
         window.open('http://localhost:8080/fx_system/frontend/web/index.php?r=sql/report7&datestart=' + datestart + '&dateend=' + dateend + '&sub_currency_id=<?php echo $sub_currency_id;?>' + '&timeframe=' + timeframe );
    }
    
    //function เรียกหน้ารายงาน
    function url_week() {
        
        //ตัดเครื่องหมาย - ออก แล้วส่ง datestart&dateend ไปยัง url ที่ต้องการ
         //ตัดเครื่องหมาย - ออก แล้วส่ง datestart&dateend ไปยัง url ที่ต้องการ
        d1 = $('#w0').val();
        var arr1 = d1.split("-");
        s1 = arr1[0];
        s2 = arr1[1];
        s3 = arr1[2];
        datestart = s3+s2+s1;
        d2 = $('#w0-2').val();
        var arr2 = d2.split("-");
        m1 = arr2[0];
        m2 = arr2[1];
        m3 = arr2[2];
        dateend = m3+m2+m1;
        
        timeframe = $("[name='opttimeframe']:checked").val()
        
         window.open('http://localhost:8080/fx_system/frontend/web/index.php?r=sql/report8&datestart=' + datestart + '&dateend=' + dateend + '&sub_currency_id=<?php echo $sub_currency_id;?>' + '&timeframe=' + timeframe );
    }
    
    
    //function เรียกหน้ารายงาน
    function url_volatility() {
        
        //ตัดเครื่องหมาย - ออก แล้วส่ง datestart&dateend ไปยัง url ที่ต้องการ
         //ตัดเครื่องหมาย - ออก แล้วส่ง datestart&dateend ไปยัง url ที่ต้องการ
        d1 = $('#w0').val();
        var arr1 = d1.split("-");
        s1 = arr1[0];
        s2 = arr1[1];
        s3 = arr1[2];
        datestart = s3+s2+s1;
        d2 = $('#w0-2').val();
        var arr2 = d2.split("-");
        m1 = arr2[0];
        m2 = arr2[1];
        m3 = arr2[2];
        dateend = m3+m2+m1;
        
        timeframe = $("[name='opttimeframe']:checked").val()
        
         window.open('http://localhost:8080/fx_system/frontend/web/index.php?r=sql/report10&datestart=' + datestart + '&dateend=' + dateend + '&sub_currency_id=<?php echo $sub_currency_id;?>' + '&timeframe=' + timeframe );
    }
    
    
    
    function url_price_range(){
        
        //ตัดเครื่องหมาย - ออก แล้วส่ง datestart&dateend ไปยัง url ที่ต้องการ
         //ตัดเครื่องหมาย - ออก แล้วส่ง datestart&dateend ไปยัง url ที่ต้องการ
         
        // ดึง date มาใช้
        d1 = $('#w0').val();
        var arr1 = d1.split("-");
        s1 = arr1[0];
        s2 = arr1[1];
        s3 = arr1[2];
        datestart = s3+"-"+s2+"-"+s1;
        
        d2 = $('#w0-2').val();
        var arr2 = d2.split("-");
        m1 = arr2[0];
        m2 = arr2[1];
        m3 = arr2[2];
        dateend = m3+"-"+m2+"-"+m1;
        
         // ดึง time มาใช้      
        t1 = $('#w1').val();
        var arr1 = t1.split(" ");
        s1 = arr1[0]+':00';
        s2 = arr1[1];
           
        if (s2 == 'PM') {
            ds = datestart + ' ' + s1;
            cds = new Date(ds);
            cds.setMinutes(cds.getMinutes()+720);
        } else {
            ds = datestart + ' ' + s1;
            cds = new Date(ds);
        }
        
        
        t2 = $('#w2').val();
        var arr2 = t2.split(" ");
        m1 = arr2[0]+':00';
        m2 = arr2[1];
        
        if (m2 == 'PM') {
            de = dateend + ' ' + m1;
            cde = new Date(de)
            cde.setMinutes(cde.getMinutes()+720);
        } else {
            de = dateend + ' ' + m1;
            cde = new Date(de)
        }
        
       
         timestart = moment(cds).format('HH:mm:ss');
         timeend = moment(cde).format('HH:mm:ss');
         

        
        window.open('http://localhost:8080/fx_system/frontend/web/index.php?r=sql/report9&datestart=' +  datestart + '&dateend=' + dateend + '&timestart=' + timestart + '&timeend=' + timeend + '&sub_currency_id=<?php echo $sub_currency_id;?>' );
    }
    
    
    
    
    
    
    
    
    
    function url_5m() {
        
        // ดึง date มาใช้
        d1 = $('#w0').val();
        var arr1 = d1.split("-");
        s1 = arr1[0];
        s2 = arr1[1];
        s3 = arr1[2];
        datestart = s3+"-"+s2+"-"+s1;
        
        d2 = $('#w0-2').val();
        var arr2 = d2.split("-");
        m1 = arr2[0];
        m2 = arr2[1];
        m3 = arr2[2];
        dateend = m3+"-"+m2+"-"+m1;
        
        
        
        window.open('http://localhost:8080/fx_system/frontend/web/index.php?r=sql/report8&datestart=' + datestart + '&dateend=' + dateend + '&sub_currency_id=<?php echo $sub_currency_id;?>' );
    }
    
    
    
    
    window.onload = function () {
        //your jQuery code here
        // jquery here     
    };
</script>
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
$data1 = [];
for ($i = 0; $i < count($rawData); $i++) {   
    $data1[] = [
        '0' => intval($rawData[$i]['oh']) * 1,
        '1' => 1,
    ];
}
$data2 = [];
for ($i = 0; $i < count($rawData); $i++) {
    $data2[] = [
        '0' => intval($rawData[$i]['ol']) * 1,
        '1' => -1,
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
?>


<br/>

<div class="row">
    <div class="col-md-6">
       
        <button type="button" class="btn btn-success" onclick = "javascript:(history.go(-1))"><i class="glyphicon glyphicon-menu-left"></i> ย้อนกลับ</button>
      <!--  <a href="index.php?r=sql/report5&sub_currency_id=<?php //echo  $sub_currency_id; ?>&year_s=<?php //echo $year_s;?>&month_id=<?php //echo $month_id;?>" class="btn btn-danger"><i class="glyphicon glyphicon-menu-right"></i> ระดับราคาเฉลี่ยราย 4 ชั่วโมง</a> -->
       
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
<?php
/* @var $this yii\web\View */
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use miloschuman\highcharts\Highstock;
use yii\web\JsExpression;
use kartik\datecontrol\Module;
use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;
use kartik\time\TimePicker;
use app\models\Subcurrency;
\conquer\momentjs\MomentjsAsset::register($this);


\conquer\momentjs\MomentjsAsset::register($this);
HighchartsAsset::register($this)->withScripts([
	'highcharts-more',
	'themes/grid'
]);
$this->title = 'Backtest ค่าเงิน';
$this->params['breadcrumbs'][] = $this->title;
?>




<div class="row">
    
    <div class="col-md-12">
    <div class="panel panel-primary">
    <div class="panel-heading">BackTest ค่าเงิน</div>
    <div class="panel-body">
            
            <form novalidate="" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left">
                   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="first-name">เลือกช่วงวันที่ <span class="required">*</span>
                        </label>
                       
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            
                                                        
                            <div class="form-group">
                                <?php echo Html::dropDownList('sub_currency', null,
                                        ArrayHelper::map(Subcurrency::find()->all(), 'id', 'name'), [
                                      // 'multiple' => 'multiple',
                                        'class' => 'form-control',
                                        'id' => 'sub_currency',
                                        'prompt' => ' -- ค่าเงิน --',                                    
                                  ]) ?>
                            </div>   
                            
                            
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
                            
                            <?php
                            
                                echo '<label class="control-label">เวลาเริ่มต้น</label>';
                                echo TimePicker::widget(
                                        [
                                            'name' => 'begin_time',
                                            'value' =>  '01:00', // Default set is AM
                                            
                                        ]); 
                            ?>
                            
                             <?php
                                
                                echo '<label class="control-label">เวลาสิ้นสุด Pending</label>';
                                echo TimePicker::widget([
                                            'name' => 'end_pending',
                                            'value' => '02:00',
                                        ]);
                                 
                            ?>
                            
                            <?php
                                
                                echo '<label class="control-label">เวลาสิ้นสุด Order</label>';
                                echo TimePicker::widget([
                                            'name' => 'end_time',
                                            'value' => '11:55 PM',
                                        ]);
                                 
                            ?>
                            <br/>
     
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">GAP : </span>
                            <input type="text" name="gap" id="gap" class="form-control" placeholder="ระบุระยะ GAP เช่น 0.0005 = 50 Point ">
                          </div>
                            
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2">TP : </span>
                            <input type="text" name="tp" id="tp" class="form-control" placeholder="ระบุระยะ TP เช่น 0.0020 = 200 Point ">
                          </div>
                            
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">SL : </span>
                            <input type="text" name="sl" id="sl" class="form-control" placeholder="ระบุระยะ SL เช่น 0.0030 = 300 Point ">
                          </div>
                            
                            

                           
                                                                                      
                            <a  class="btn btn-info btn-block" onclick = "javascript:url_backtest()"><i class="fa fa-search"></i>START</a> 
                                                                             
                        </div>
                                      
                    </div>
                </form>
                        
        </div>
        </div>        
        </div>
        </div>




<script type="text/javascript">
    //function เรียกหน้ารายงาน
    function url_backtest() {
        
        //ตัดเครื่องหมาย - ออก แล้วส่ง datestart&dateend ไปยัง url ที่ต้องการ
         //ตัดเครื่องหมาย - ออก แล้วส่ง datestart&dateend ไปยัง url ที่ต้องการ
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
        
        // ดึง time มาใช้
        t2 = $('#w2').val();
        var arr2 = t2.split(" ");
        m1 = arr2[0]+':00';
        m2 = arr2[1];
        
        if (m2 == 'PM') {
            dp = dateend + ' ' + m1;
            cdp = new Date(dp)
            cdp.setMinutes(cdp.getMinutes()+720);
        } else {
            dp = dateend + ' ' + m1;
            cdp = new Date(dp)
        }
        
        
             // ดึง time มาใช้
        t3 = $('#w3').val();
        var arr3 = t3.split(" ");
        m1 = arr3[0]+':00';
        m2 = arr3[1];
        
        if (m2 == 'PM') {
            de = dateend + ' ' + m1;
            cde = new Date(de)
            cde.setMinutes(cde.getMinutes()+720);
        } else {
            de = dateend + ' ' + m1;
            cde = new Date(de)
        }
        
       
         timestart = moment(cds).format('HH:mm:ss');
         timepending = moment(cdp).format('HH:mm:ss');
         timeend = moment(cde).format('HH:mm:ss');
                
        sub_currency = $("#sub_currency option:selected").val();
        
        gap = $("#gap").val();
        tp = $("#tp").val();
        sl = $("#sl").val();
        
                
         window.open('http://localhost:8080/fx_system/frontend/web/index.php?r=backtest/backtest1&datestart=' + datestart + '&dateend=' + dateend  + '&timestart=' + timestart + '&timepending=' + timepending + '&timeend=' + timeend + '&gap=' + gap + '&tp=' + tp + '&sl=' + sl  + '&sub_currency=' +  sub_currency  );
    }
    
    
    
    
    
    </script>
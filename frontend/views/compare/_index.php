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
HighchartsAsset::register($this)->withScripts([
	'highcharts-more',
	'themes/grid'
]);
$this->title = 'เปรียบเทียบพฤติกรรมระหว่างคู่เงิน';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="row">
    
    <div class="col-md-12">
    <div class="panel panel-primary">
    <div class="panel-heading">เลือกคู่เงินเพื่อเปรียบเทียบ N-Core, Pcore</div>
    <div class="panel-body">
            
            <form novalidate="" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left">
                   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="first-name">เลือกช่วงวันที่ <span class="required">*</span>
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
                            
                            <div class="form-group">              
                                <label class="radio-inline"><input type="radio" name="opttimeframe" value="_h1" >1 ชม.</label>
                                <label class="radio-inline"><input type="radio" name="opttimeframe" value="_m15">15 นาที</label>
                                <label class="radio-inline"><input type="radio" name="opttimeframe" value="_m5" checked>5 นาที</label>
                            </div>
                            
                            
                            <div class="form-group">
                                <?php echo Html::dropDownList('sub_currency1', null,
                                        ArrayHelper::map(Subcurrency::find()->all(), 'id', 'name'), [
                                      // 'multiple' => 'multiple',
                                        'class' => 'form-control',
                                        'id' => 'sub_currency1',
                                        'prompt' => ' -- คู่เงินที่ 1 --',                                    
                                  ]) ?>
                            </div>   
                            
                            <div class="form-group">
                                    <?php echo Html::dropDownList('sub_currency2', null,
                                        ArrayHelper::map(Subcurrency::find()->all(), 'id', 'name'), [
                                      // 'multiple' => 'multiple',
                                        'class' => 'form-control',
                                        'id' => 'sub_currency2',
                                        'prompt' => ' -- คู่เงินที่ 2 --',                                    
                                  ]) ?>
                            </div>
                                                                                      
                            <a  class="btn btn-info btn-block" onclick = "javascript:url_day_compare()"><i class="fa fa-search"></i>ดูพฤติกรรมกราฟ</a> 
                                                                             
                        </div>
                                      
                    </div>
                </form>
                        
        </div>
        </div>        
        </div>
        </div>




<script type="text/javascript">
    //function เรียกหน้ารายงาน
    function url_day_compare() {
        
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
        
     
        sub_currency1 = $("#sub_currency1 option:selected").val();
        sub_currency2 = $("#sub_currency2 option:selected").val();
       
   
        
         window.open('http://localhost:8080/fx_system/frontend/web/index.php?r=compare/compare1&datestart=' + datestart + '&dateend=' + dateend + '&sub_currency1=' +  sub_currency1 + '&sub_currency2=' +  sub_currency2 + '&timeframe=' + timeframe);
    }
    
    
    
    
    
    </script>
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


<br/>
<br/>

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
                                    <?php echo Html::dropDownList('sub_currency1', null,
                                        ArrayHelper::map(Subcurrency::find()->all(), 'id', 'name'), [
                                      // 'multiple' => 'multiple',
                                        'class' => 'form-control',
                                        'id' => 'id',
                                        'prompt' => ' -- คู่เงินที่ 1 --'
                                  ]) ?>
                            </div>   
                            
                            <div class="form-group">
                                    <?php echo Html::dropDownList('sub_currency2', null,
                                        ArrayHelper::map(Subcurrency::find()->all(), 'id', 'name'), [
                                      // 'multiple' => 'multiple',
                                        'class' => 'form-control',
                                        'id' => 'id',
                                        'prompt' => ' -- คู่เงินที่ 2 --'
                                  ]) ?>
                            </div>
                                
           
                                                           
                            <a  class="btn btn-info btn-block" onclick = "javascript:url_day_compare()"><i class="fa fa-search"></i>ดูพฤติกรรมกราฟในรอบวัน</a> 
                            <a  class="btn btn-danger btn-block" onclick = "javascript:url_week_compare()"><i class="fa fa-search"></i>ดูพฤติกรรมกราฟในรอบสัปดาห์</a>
                                                    
                        </div>
                                      
                    </div>
                </form>
                        
        </div>
        </div>        
        </div>
        </div>


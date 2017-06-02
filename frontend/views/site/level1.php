<?php
$this->title = ' แยกตามระดับความรุนแรง-ช่วงเวลา';
$this->params['breadcrumbs'][]=$this->title;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\Hospcode;
use kartik\widgets\Select2;
use yii\widgets\ActiveForm;


?>

<?php
if (isset($dataProvider))
    $dev = \yii\helpers\Html::a('คุณไอน้ำ เรืองโพน', 'https://fb.com/inam06', ['target' => '_blank']);?>
<?php $form = ActiveForm::begin(['method' => 'get',
'action' => Url::to(['report/level1']),]); ?>


<div class='well'>
        ระหว่างวันที่:
        <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-5">
            <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ],
            'options'=>[
                'class'=>'form-control'
            ],
        ]);
        ?>           
        ถึงวันที่:
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ],
            'options'=>[
                'class'=>'form-control'
            ],            
        ]);
        ?>
        </div>        
            
        <div class="col-xs-4 col-sm-4 col-md-2">
            <button class='btn btn-danger'>ประมวลผล</button>
        </div>    
         
</div>   
</div>
<?php ActiveForm::end(); ?>

<div class="box-body">
                <?php

                use miloschuman\highcharts\Highcharts;
                ?>
                <div style="display: none">
                    <?php
                    echo Highcharts::widget([
                        'scripts' => [
                            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                            //'modules/exporting', // adds Exporting button/menu to chart
                            //'themes/grid',       // applies global 'grid' theme to all charts
                            //'highcharts-3d',
                            'modules/drilldown'
                        ]
                    ]);
                    ?>
                </div>
<?php


                // เตรียมข้อมูลสำหรับกราฟ
                $model = $dataProvider->getModels();
                $data = [];
                for ($i = 0; $i < count($model); $i++) {
                    $data[] = [
                        'name' => $model[$i]['level11'],
                        'y' => $model[$i]['tt1'] * 1
                    ];
                }
                $chart_data = json_encode($data);
                ?>


                <div id="chart">แสดงกราฟ</div>

                <?php
                //$topic = $topic['topic'];
                $this->registerJs(" 
    $(function () {
    $('#chart').highcharts({
        chart: {
            type: 'column'
        },
         credits: {
            enabled: false
        },
        title: {
            text: 'แยกตามระดับความรุนแรง-ช่วงเวลา'
        },
        
         yAxis: {
            min: 0,
            title: {
                text: 'จำนวน'
            },
            
        },
         xAxis: {
            type: 'category'
        },
       legend: {
            enabled: true
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
                name: 'ระดับ',
                colorByPoint: true,
                data:$chart_data
        }]
     });
    });
");
                ?>
    </div>
<!-- จบกราฟ-->

<hr>

<?php Pjax::begin();?> 
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
    //'filterModel' => $searchModel,
    'responsive' => TRUE,
    'hover' => true,
    'floatHeader' => FALSE,
    'panel' => [
        'heading'=>'แยกตามระดับความรุนแรง-ช่วงเวลา',
        'before' => '',
        'type' => \kartik\grid\GridView::TYPE_SUCCESS,
       
    ],
    'columns'=>[
        //['class'=>'yii\grid\SerialColumn'],        
        [
            'label'=>'ระดับความรุนแรง',
            'attribute'=>'level11'
        ],
        [
            'label'=>'จำนวน',
            'attribute'=>'tt1'
        ],
        ]
]);


?>

<?php
$script = <<< JS
$(function(){
    $("label[title='Show all data']").hide();
});
        
$('#btn_sql').on('click', function(e) {
    
   $('#sql').toggle();
});
JS;
$this->registerJs($script);
?>
</div>

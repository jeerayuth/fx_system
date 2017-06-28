<?php
/* @var $this yii\web\View */
use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use miloschuman\highcharts\Highstock;
use yii\web\JsExpression;
HighchartsAsset::register($this)->withScripts([
	'highcharts-more',
	'themes/grid'
]);
$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>



<?php
//เตรียมชุดข้อมูลวันที่
$text_date_s = array();
$data_date_s = [];
//เตรียมชุดข้อมูลไปใส่ให้กราฟ แกน x,y
for ($i = 0; $i < count($rawData); $i++) {
    $text_date_s = $rawData[$i]['date_s'];
    array_push($data_date_s, $text_date_s);   
}
//print_r($data_date_s);
$js_date_s = json_encode($data_date_s);


?>

<center><h4><?php echo $report_name; ?></h4></center>


<?php
$js = <<<MOO
    $(function () {
        var seriesOptions = [],
            seriesCounter = 0,
            date_s = $js_date_s;
            unit = $unit;      
            data_arr = [];
            currency_table = '$currency_table'; 
            timeframe = '$timeframe';
             
        $.each(date_s, function(i, name) {
           $.getJSON('index.php?r=json/report1&date_s='+ name + '&unit='+ unit + '&currency_table=' + currency_table + '&timeframe=' + timeframe +  '&callback=?',	function(data) {  
               
                // convert data object field to int,float
                for (var l=0; l < data.length; l++) {
                    if(data[l].price_range!= 0) {
                        data_arr[l] = parseInt(data[l].price_range) * 1; 
                    } else {
                        data_arr[l] = 1 ; 
                    }     
                }
                    
                seriesOptions[i] = {
                    name: name,
                    data: data_arr
                }; 
        
                // As we're loading the data asynchronously, we don't know what order it will arrive. So
                // we keep a counter and create the chart when all the data is loaded.
                seriesCounter++;          
                if (seriesCounter == date_s.length) {
                    createChart(seriesOptions);
                }
                // clear old array before next step
                data_arr = [];
            });
        });
    });
MOO;
$this->registerJs($js);
echo Highstock::widget([
    // The highcharts initialization statement will be wrapped in a function
    // named 'createChart' with one parameter: data.
    
    'callback' => 'createChart',
    'options' => [
        'chart' => [
           'height' => 600
        ],
        'rangeSelector' => [
            'selected' => 4
        ],         
        'yAxis' => [
            'labels' => [
                'formatter' => new JsExpression("function () {
                    return (this.value > 0 ? ' + ' : '') + this.value + ' จุด';
                }")
            ],
            'plotLines' => [[
                'value' => 0,
                'width' => 2,
                'color' => 'silver'
            ]]
        ],
        'plotOptions' => [
            'series' => [
                'compare' => 'percent'
            ]
        ],
        'tooltip' => [
            'headerFormat' => '<b>{series.name} เวลา {series.x} </b><br/>',
            'valueDecimals' => 2 ,     
            'formatter' => new JsExpression("function() {   
                    s = this.x+2;
                    text = '';
                    
                    $.each(this.points, function(i, point) {
                         text +=   '<br/><span style=\"color:' + this.series.color + '\">' + this.series.name + ' เวลา' +  s + ' ราคา ' + point.y + 'จุด</span> ';                           
                    });
     
                    return text ;
              }") 
                                  
        ],
        'series' => new JsExpression('data'), // Here we use the callback parameter, data
    ]
]);
?>
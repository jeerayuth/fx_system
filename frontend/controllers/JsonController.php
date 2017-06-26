<?php
namespace frontend\controllers;
use Yii;
use frontend\components\CommonController;

class JsonController extends CommonController {
    
    //รายงานดูพฤติกรรมราคาในกราฟราย 1 ชั่วโมง ทั้งวัน
    public function actionReport1($date_s = '2017-01-04' ,$unit,$currency_table,$timeframe,$callback = null) {
          \Yii::$app->response->format = \yii\web\Response::FORMAT_JSONP;
          
         $sql="select 
                tb.time_second as `time_second` , 
                IF(t1.`open` < t2.`OPEN`,t2.open-t1.open,
                                IF(t1.`open` > t2.`OPEN`, t2.open - t1.open, 1
                                                )
                )*$unit as `price_range`
                FROM price_dynamic$timeframe tb
                LEFT JOIN (
                        select DATE_S ,TIME_S,`OPEN` from $currency_table where DATE_S = '$date_s'
                ) t1 on (t1.TIME_S = tb.time_first)
                LEFT JOIN (
                        select DATE_S,TIME_S,`OPEN` from $currency_table where DATE_S = '$date_s'
                ) t2 on (t2.TIME_S = tb.time_second) ";
          
         
         try {               
            $data = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        } 
  
     
       return ['callback' => $callback, 'data' => $data];
    
    
    }
    
    
    //รายงานดูพฤติกรรมราคาในกราฟราย 5 นาที ทั้งวัน แบบเลือกชั่วโมง
    public function actionReport2($date_s ='2017-01-04',$unit ,$callback = null) {
          \Yii::$app->response->format = \yii\web\Response::FORMAT_JSONP;
          
         $sql= "SELECT
                t1.DATE_S,m5.time_first,t1.`OPEN` as price_open1, m5.time_second,t2.`OPEN` as price_open2,
                IF(t1.`open` < t2.`OPEN`,t2.open-t1.open,
                                IF(t1.`open` > t2.`OPEN`, t2.open - t1.open, 1
                                                )
                )*$unit as price_range
                FROM price_dynamic_m5 m5
                INNER JOIN (
                        select DATE_S,TIME_S,`OPEN` from usdjpy_m5 where DATE_S = '$date_s'
                ) t1 on (t1.TIME_S = m5.time_first)
                INNER JOIN (
                        select DATE_S,TIME_S,`OPEN` from usdjpy_m5 where DATE_S = '$date_s'
                ) t2 on (t2.TIME_S = m5.time_second) ";
                
               /* AND m5.time_first BETWEEN '$timestart' AND  '$timeend'  "; */
          
         try {               
            $data = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        } 
        
           
       return ['callback' => $callback, 'data' => $data];
    
    
    }
    
   
}
?>
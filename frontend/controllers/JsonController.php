<?php
namespace frontend\controllers;
use Yii;
use frontend\components\CommonController;

class JsonController extends CommonController {
    
    //รายงานดูพฤติกรรมราคาในกราฟราย
    public function actionReport1($date_s,$unit,$currency_table,$timeframe,$callback = null) {
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
    
    
}?>
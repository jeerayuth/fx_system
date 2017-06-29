<?php

namespace frontend\controllers;

use yii;
use yii\data\SqlDataProvider;


class CompareController extends \yii\web\Controller {

    public function actionIndex() {
        $session = Yii::$app->session;
        return $this->render('//compare/index');
    }
    
    
    public function actionCompare1() {


             
        // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql = "select
                concat(t1.DATE_S,'   time@ ', tb.time_second) as date_s,
                tb.time_second as `time_second` , 
                
                   IF(t1.`open` < t2.`OPEN`,t2.open-t1.open,
                        IF(t1.`open` > t2.`OPEN`, t2.open - t1.open, 1
                           )                  
                )*1000 as `price_range_1` ,
                
                    IF(t3.`open` < t4.`OPEN`,t4.open-t3.open,
                        IF(t3.`open` > t4.`OPEN`, t4.open - t3.open, 1
                           )                  
                )*100000 as `price_range_2`

                    
                        
                FROM price_dynamic_h1 tb

                LEFT JOIN (
                        select DATE_S ,TIME_S,`OPEN` from usdjpy_h1 where DATE_S = '2017-05-25'
                ) t1 on (t1.TIME_S = tb.time_first)
                LEFT JOIN (
                        select DATE_S,TIME_S,`OPEN` from usdjpy_h1 where DATE_S = '2017-05-25'
                ) t2 on (t2.TIME_S = tb.time_second) 


								 LEFT JOIN (
                        select DATE_S ,TIME_S,`OPEN` from eurusd_h1 where DATE_S = '2017-05-25'
                ) t3 on (t3.TIME_S = tb.time_first)
                LEFT JOIN (
                        select DATE_S,TIME_S,`OPEN` from eurusd_h1  where DATE_S = '2017-05-25'
                ) t4 on (t4.TIME_S = tb.time_second)  ";
                 
        
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();  
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
                   
        return $this->render('compare1', [
                    'rawData' => $rawData,             
        ]);
    }

   
    
    
  

}

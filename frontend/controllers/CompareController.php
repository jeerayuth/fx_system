<?php

namespace frontend\controllers;

use yii;
use yii\data\SqlDataProvider;


class CompareController extends \yii\web\Controller {

    public function actionIndex() {
        $session = Yii::$app->session;
        return $this->render('//compare/index');
    }
    
    
    public function actionCompare1($datestart,$dateend,$sub_currency1,$sub_currency2) {
        
         $currency_table1 = $sub_currency1."_h1";
         $currency_table2 = $sub_currency2."_h1";
         
         $report_name = "กราฟเปรียบเทียบ N-Core, P-Core ระหว่างค่าเงิน $sub_currency1 กับ $sub_currency2 ระหว่างวันที่ $datestart ถึงวันที่ $dateend ";
                
         // sql find units in sub_current table
        $sql_find1 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency1' ";
        $sql_find2 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency2' ";
        
        try {
            $data_unit1 = \yii::$app->db->createCommand($sql_find1)->queryAll();
            $data_unit2 = \yii::$app->db->createCommand($sql_find2)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $unit1 = $data_unit1[0]['units'];
        $unit2 = $data_unit2[0]['units'];
        
            
        // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql = "select
                concat(t1.DATE_S,'   time@ ', tb.time_second) as date_s,
                tb.time_second as `time_second` , 
                
                   IF(t1.`open` < t2.`OPEN`,t2.open-t1.open,
                        IF(t1.`open` > t2.`OPEN`, t2.open - t1.open, 1
                           )                  
                )*$unit1 as `price_range_1` ,
                
                    IF(t3.`open` < t4.`OPEN`,t4.open-t3.open,
                        IF(t3.`open` > t4.`OPEN`, t4.open - t3.open, 1
                           )                  
                )*$unit2 as `price_range_2`
                                         
                FROM price_dynamic_h1 tb

                LEFT JOIN (
                        select DATE_S ,TIME_S,`OPEN` from $currency_table1 where DATE_S between '$datestart' and '$dateend'
                ) t1 on (t1.TIME_S = tb.time_first)
                LEFT JOIN (
                        select DATE_S,TIME_S,`OPEN` from $currency_table1 where DATE_S between '$datestart' and '$dateend'
                ) t2 on (t2.TIME_S = tb.time_second) 


                LEFT JOIN (
                        select DATE_S ,TIME_S,`OPEN` from $currency_table2 where DATE_S between '$datestart' and '$dateend'
                ) t3 on (t3.TIME_S = tb.time_first)
                LEFT JOIN (
                        select DATE_S,TIME_S,`OPEN` from $currency_table2  where DATE_S between '$datestart' and '$dateend'
                ) t4 on (t4.TIME_S = tb.time_second)  ";
        
                
          
                 
        
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();  
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
                   
        return $this->render('compare1', [
                    'rawData' => $rawData,   
                    'report_name' => $report_name,
                    'sub_currency1' => $sub_currency1,
                    'sub_currency2' => $sub_currency2,
                    'datestart' => $datestart,
                    'dateend' => $dateend,
                     
        ]); 
    }

   
    
    
  

}

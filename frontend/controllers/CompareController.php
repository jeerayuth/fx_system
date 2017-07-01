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
        
        // sql find first open price @ first day select
        $sql_find_open_price_first1 = "SELECT open FROM $currency_table1 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first2 = "SELECT open FROM $currency_table2 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";

        
        try {
            $data_unit1 = \yii::$app->db->createCommand($sql_find1)->queryAll();
            $data_unit2 = \yii::$app->db->createCommand($sql_find2)->queryAll();
            $data_open_price_first1 = \yii::$app->db->createCommand($sql_find_open_price_first1)->queryAll();
            $data_open_price_first2 = \yii::$app->db->createCommand($sql_find_open_price_first2)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $unit1 = $data_unit1[0]['units'];
        $unit2 = $data_unit2[0]['units'];
        
        // first open price @ date first selected
        $open_price_first1 = $data_open_price_first1[0]['open'];
        $open_price_first2 = $data_open_price_first2[0]['open'];

            
        // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql1 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first1 < t1.`OPEN`,t1.open-$open_price_first1,
                                    IF($open_price_first1 > t1.`open`, t1.open - $open_price_first1  , 1
                          )
                    )*$unit1 as price_range_1
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table1 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
        // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql2 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first2 < t1.`OPEN`,t1.open-$open_price_first2,
                                    IF($open_price_first2 > t1.`open`, t1.open - $open_price_first2  , 1
                          )
                    )*$unit2 as price_range_2
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table2 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
                
          
                
        
        try {
            $rawData1 = \yii::$app->db->createCommand($sql1)->queryAll();  
            $rawData2 = \yii::$app->db->createCommand($sql2)->queryAll(); 
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
                   
        return $this->render('compare1', [
                    'rawData1' => $rawData1,  
                    'rawData2' => $rawData2, 
                    'report_name' => $report_name,
                    'sub_currency1' => $sub_currency1,
                    'sub_currency2' => $sub_currency2,
                    'datestart' => $datestart,
                    'dateend' => $dateend,
                     
        ]);  
    }

   
    
    
  

}

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
    
    
    public function actionMultipleform() {
        $session = Yii::$app->session;
        return $this->render('//compare/multipleform');
    }
    
    
    public function actionCompare2($datestart,$dateend,$sub_currency1,$sub_currency2,$sub_currency3,$sub_currency4,$sub_currency5,$sub_currency6,$sub_currency7,$sub_currency8,$sub_currency9,$sub_currency10,$sub_currency11,$sub_currency12) {
        
         $currency_table1 = $sub_currency1."_h1";
         $currency_table2 = $sub_currency2."_h1";
         $currency_table3 = $sub_currency3."_h1";
         $currency_table4 = $sub_currency4."_h1";
         $currency_table5 = $sub_currency5."_h1";        
         $currency_table6 = $sub_currency6."_h1";
                
         $currency_table7 = $sub_currency7."_h1";
         $currency_table8 = $sub_currency8."_h1";
         $currency_table9 = $sub_currency9."_h1";
         $currency_table10 = $sub_currency10."_h1";
         $currency_table11 = $sub_currency11."_h1";
         $currency_table12 = $sub_currency12."_h1";
         
         
         $report_name = "กราฟเปรียบเทียบ N-Core, P-Core  ระหว่างวันที่ $datestart ถึงวันที่ $dateend ";
                
         // sql find units in sub_current table
        $sql_find1 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency1' ";
        $sql_find2 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency2' ";
        $sql_find3 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency3' ";
        $sql_find4 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency4' ";
        $sql_find5 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency5' ";
        $sql_find6 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency6' ";
        
        $sql_find7 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency7' ";
        $sql_find8 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency8' ";
        $sql_find9 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency9' ";
        $sql_find10 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency10' ";
        $sql_find11 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency11' ";
        $sql_find12 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency12' ";
        
        
        
        // sql find first open price @ first day select
        $sql_find_open_price_first1 = "SELECT open FROM $currency_table1 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first2 = "SELECT open FROM $currency_table2 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first3 = "SELECT open FROM $currency_table3 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first4 = "SELECT open FROM $currency_table4 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first5 = "SELECT open FROM $currency_table5 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first6 = "SELECT open FROM $currency_table6 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        
        $sql_find_open_price_first7 = "SELECT open FROM $currency_table7 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first8 = "SELECT open FROM $currency_table8 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first9 = "SELECT open FROM $currency_table9 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first10 = "SELECT open FROM $currency_table10 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first11 = "SELECT open FROM $currency_table11 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first12 = "SELECT open FROM $currency_table12 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";

        
        
        try {
            $data_unit1 = \yii::$app->db->createCommand($sql_find1)->queryAll();
            $data_unit2 = \yii::$app->db->createCommand($sql_find2)->queryAll();
            $data_unit3 = \yii::$app->db->createCommand($sql_find3)->queryAll();
            $data_unit4 = \yii::$app->db->createCommand($sql_find4)->queryAll();
            $data_unit5 = \yii::$app->db->createCommand($sql_find5)->queryAll();
            $data_unit6 = \yii::$app->db->createCommand($sql_find6)->queryAll();
            
            $data_unit7 = \yii::$app->db->createCommand($sql_find7)->queryAll();
            $data_unit8 = \yii::$app->db->createCommand($sql_find8)->queryAll();
            $data_unit9 = \yii::$app->db->createCommand($sql_find9)->queryAll();
            $data_unit10 = \yii::$app->db->createCommand($sql_find10)->queryAll();
            $data_unit11 = \yii::$app->db->createCommand($sql_find11)->queryAll();
            $data_unit12 = \yii::$app->db->createCommand($sql_find12)->queryAll();
            
            
            
            $data_open_price_first1 = \yii::$app->db->createCommand($sql_find_open_price_first1)->queryAll();
            $data_open_price_first2 = \yii::$app->db->createCommand($sql_find_open_price_first2)->queryAll();
            $data_open_price_first3 = \yii::$app->db->createCommand($sql_find_open_price_first3)->queryAll();
            $data_open_price_first4 = \yii::$app->db->createCommand($sql_find_open_price_first4)->queryAll();
            $data_open_price_first5 = \yii::$app->db->createCommand($sql_find_open_price_first5)->queryAll();
            $data_open_price_first6 = \yii::$app->db->createCommand($sql_find_open_price_first6)->queryAll();
            
            $data_open_price_first7 = \yii::$app->db->createCommand($sql_find_open_price_first7)->queryAll();
            $data_open_price_first8 = \yii::$app->db->createCommand($sql_find_open_price_first8)->queryAll();
            $data_open_price_first9 = \yii::$app->db->createCommand($sql_find_open_price_first9)->queryAll();
            $data_open_price_first10 = \yii::$app->db->createCommand($sql_find_open_price_first10)->queryAll();
            $data_open_price_first11 = \yii::$app->db->createCommand($sql_find_open_price_first11)->queryAll();
            $data_open_price_first12 = \yii::$app->db->createCommand($sql_find_open_price_first12)->queryAll();
            
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        
        $unit1 = $data_unit1[0]['units'];
        $unit2 = $data_unit2[0]['units'];
        $unit3 = $data_unit3[0]['units'];
        $unit4 = $data_unit4[0]['units'];
        $unit5 = $data_unit5[0]['units'];
        $unit6 = $data_unit6[0]['units'];
        
        $unit7 = $data_unit7[0]['units'];
        $unit8 = $data_unit8[0]['units'];
        $unit9 = $data_unit9[0]['units'];
        $unit10 = $data_unit10[0]['units'];
        $unit11 = $data_unit11[0]['units'];
        $unit12 = $data_unit12[0]['units'];
        
        
        // first open price @ date first selected
        $open_price_first1 = $data_open_price_first1[0]['open'];
        $open_price_first2 = $data_open_price_first2[0]['open'];
        $open_price_first3 = $data_open_price_first3[0]['open'];
        $open_price_first4 = $data_open_price_first4[0]['open'];
        $open_price_first5 = $data_open_price_first5[0]['open'];
        $open_price_first6 = $data_open_price_first6[0]['open'];
        
        $open_price_first7 = $data_open_price_first7[0]['open'];
        $open_price_first8 = $data_open_price_first8[0]['open'];
        $open_price_first9 = $data_open_price_first9[0]['open'];
        $open_price_first10 = $data_open_price_first10[0]['open'];
        $open_price_first11 = $data_open_price_first11[0]['open'];
        $open_price_first12 = $data_open_price_first12[0]['open'];

            
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
        
        
        // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql3 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first3 < t1.`OPEN`,t1.open-$open_price_first3,
                                    IF($open_price_first3 > t1.`open`, t1.open - $open_price_first3  , 1
                          )
                    )*$unit3 as price_range_3
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table3 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
                // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql4 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first4 < t1.`OPEN`,t1.open-$open_price_first4,
                                    IF($open_price_first4 > t1.`open`, t1.open - $open_price_first4  , 1
                          )
                    )*$unit4 as price_range_4
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table4 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
         // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql5 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first5 < t1.`OPEN`,t1.open-$open_price_first5,
                                    IF($open_price_first5 > t1.`open`, t1.open - $open_price_first5  , 1
                          )
                    )*$unit5 as price_range_5
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table5 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
         // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql6 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first6 < t1.`OPEN`,t1.open-$open_price_first6,
                                    IF($open_price_first6 > t1.`open`, t1.open - $open_price_first6  , 1
                          )
                    )*$unit6 as price_range_6
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table6 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
        
        // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql7 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first7 < t1.`OPEN`,t1.open-$open_price_first7,
                                    IF($open_price_first7 > t1.`open`, t1.open - $open_price_first7  , 1
                          )
                    )*$unit7 as price_range_7
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table7 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
        
          // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql8 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first8 < t1.`OPEN`,t1.open-$open_price_first8,
                                    IF($open_price_first8 > t1.`open`, t1.open - $open_price_first8  , 1
                          )
                    )*$unit8 as price_range_8
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table8 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
        
         // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql9 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first9 < t1.`OPEN`,t1.open-$open_price_first9,
                                    IF($open_price_first9 > t1.`open`, t1.open - $open_price_first9  , 1
                          )
                    )*$unit9 as price_range_9
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table9 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
         // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql10 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first10 < t1.`OPEN`,t1.open-$open_price_first10,
                                    IF($open_price_first10 > t1.`open`, t1.open - $open_price_first10  , 1
                          )
                    )*$unit10 as price_range_10
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table10 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
        
         // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql11 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first11 < t1.`OPEN`,t1.open-$open_price_first11,
                                    IF($open_price_first11 > t1.`open`, t1.open - $open_price_first11  , 1
                          )
                    )*$unit11 as price_range_11
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table11 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
        
         // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql12 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first12 < t1.`OPEN`,t1.open-$open_price_first12,
                                    IF($open_price_first12 > t1.`open`, t1.open - $open_price_first12  , 1
                          )
                    )*$unit12 as price_range_12
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table12 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
 
        
        
        
        
       
                                            
        
         $sql_sum1 = "SELECT  date_s, time_second , sum(price_range_1) as sum_price_range1   FROM (

                             SELECT 
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

                    UNION ALL

                            SELECT 
                                concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 

                                IF($open_price_first2 < t1.`OPEN`,t1.open-$open_price_first2,
                                                IF($open_price_first2 > t1.`open`, t1.open - $open_price_first2  , 1
                                      )
                                )*$unit2 as price_range_1

                            FROM price_dynamic_h1 h1

                            LEFT JOIN (
                                        select DATE_S,TIME_S,`OPEN` from $currency_table2 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                            ) t1 on (t1.TIME_S = h1.time_second)

                            GROUP BY t1.DATE_S,h1.time_second
                            
                    
                    UNION ALL


                    SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                        IF($open_price_first3 < t1.`OPEN`,t1.open-$open_price_first3,
                                        IF($open_price_first3 > t1.`open`, t1.open - $open_price_first3  , 1
                              )
                        )*$unit3 as price_range_1

                    FROM price_dynamic_h1 h1

                    LEFT JOIN (
                                select DATE_S,TIME_S,`OPEN` from $currency_table3 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                    ) t1 on (t1.TIME_S = h1.time_second)
                    
                    GROUP BY t1.DATE_S,h1.time_second
                    
                    UNION ALL
                    
                    SELECT 
                        concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 

                        IF($open_price_first4 < t1.`OPEN`,t1.open-$open_price_first4,
                                        IF($open_price_first4 > t1.`open`, t1.open - $open_price_first4  , 1
                              )
                        )*$unit4 as price_range_1

                    FROM price_dynamic_h1 h1

                    LEFT JOIN (
                                select DATE_S,TIME_S,`OPEN` from $currency_table4 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                    ) t1 on (t1.TIME_S = h1.time_second)

                    GROUP BY t1.DATE_S,h1.time_second

                
                UNION ALL
                
                    SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first5 < t1.`OPEN`,t1.open-$open_price_first5,
                                    IF($open_price_first5 > t1.`open`, t1.open - $open_price_first5  , 1
                          )
                    )*$unit5 as price_range_1
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table5 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)
                GROUP BY t1.DATE_S,h1.time_second
                

                UNION ALL
                
                
                    SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first6 < t1.`OPEN`,t1.open-$open_price_first6,
                                    IF($open_price_first6 > t1.`open`, t1.open - $open_price_first6  , 1
                          )
                    )*$unit6 as price_range_1
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table6 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)
                GROUP BY t1.DATE_S,h1.time_second
                
             

                        ) ts

                GROUP BY date_s,time_second ";



        
         
         $sql_sum2 = "SELECT  date_s, time_second , sum(price_range_2) as sum_price_range2   FROM (
                                
                              
                        SELECT 
                            concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 

                            IF($open_price_first7 < t1.`OPEN`,t1.open-$open_price_first7,
                                            IF($open_price_first7 > t1.`open`, t1.open - $open_price_first7  , 1
                                  )
                            )*$unit7 as price_range_2

                        FROM price_dynamic_h1 h1

                        LEFT JOIN (
                                    select DATE_S,TIME_S,`OPEN` from $currency_table7 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                        ) t1 on (t1.TIME_S = h1.time_second)


                        GROUP BY t1.DATE_S,h1.time_second
                        
            UNION ALL
            
                        SELECT 
                            concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 

                            IF($open_price_first8 < t1.`OPEN`,t1.open-$open_price_first8,
                                            IF($open_price_first8 > t1.`open`, t1.open - $open_price_first8  , 1
                                  )
                            )*$unit8 as price_range_2

                        FROM price_dynamic_h1 h1

                        LEFT JOIN (
                                    select DATE_S,TIME_S,`OPEN` from $currency_table8 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                        ) t1 on (t1.TIME_S = h1.time_second)

                        GROUP BY t1.DATE_S,h1.time_second
                        

            UNION ALL
            
                    SELECT 
                        concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 

                        IF($open_price_first9 < t1.`OPEN`,t1.open-$open_price_first9,
                                        IF($open_price_first9 > t1.`open`, t1.open - $open_price_first9  , 1
                              )
                        )*$unit9 as price_range_2

                    FROM price_dynamic_h1 h1

                    LEFT JOIN (
                                select DATE_S,TIME_S,`OPEN` from $currency_table9 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                    ) t1 on (t1.TIME_S = h1.time_second)

                    GROUP BY t1.DATE_S,h1.time_second
                    

            UNION ALL
            

                SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first10 < t1.`OPEN`,t1.open-$open_price_first10,
                                    IF($open_price_first10 > t1.`open`, t1.open - $open_price_first10  , 1
                          )
                    )*$unit10 as price_range_2
                                                             
                FROM price_dynamic_h1 h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN` from $currency_table10 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)

                GROUP BY t1.DATE_S,h1.time_second
                
           UNION ALL

                      SELECT 
                            concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 

                            IF($open_price_first11 < t1.`OPEN`,t1.open-$open_price_first11,
                                            IF($open_price_first11 > t1.`open`, t1.open - $open_price_first11  , 1
                                  )
                            )*$unit11 as price_range_2

                        FROM price_dynamic_h1 h1

                        LEFT JOIN (
                                    select DATE_S,TIME_S,`OPEN` from $currency_table11 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                        ) t1 on (t1.TIME_S = h1.time_second)
                        GROUP BY t1.DATE_S,h1.time_second
                        
            
            UNION ALL

                      SELECT 
                            concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 

                            IF($open_price_first12 < t1.`OPEN`,t1.open-$open_price_first12,
                                            IF($open_price_first12 > t1.`open`, t1.open - $open_price_first12  , 1
                                  )
                            )*$unit12 as price_range_2

                        FROM price_dynamic_h1 h1

                        LEFT JOIN (
                                    select DATE_S,TIME_S,`OPEN` from $currency_table12 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                        ) t1 on (t1.TIME_S = h1.time_second)
                        GROUP BY t1.DATE_S,h1.time_second
                        
            
        
         ) ts

                GROUP BY date_s,time_second ";

  
                      
                
        
        try {
            $rawData1 = \yii::$app->db->createCommand($sql1)->queryAll();  
            $rawData2 = \yii::$app->db->createCommand($sql2)->queryAll();
            $rawData3 = \yii::$app->db->createCommand($sql3)->queryAll(); 
            $rawData4 = \yii::$app->db->createCommand($sql4)->queryAll();
            $rawData5 = \yii::$app->db->createCommand($sql5)->queryAll();
            $rawData6 = \yii::$app->db->createCommand($sql6)->queryAll();
            
            $rawData7 = \yii::$app->db->createCommand($sql7)->queryAll();
            $rawData8 = \yii::$app->db->createCommand($sql8)->queryAll();
            $rawData9 = \yii::$app->db->createCommand($sql9)->queryAll();
            $rawData10 = \yii::$app->db->createCommand($sql10)->queryAll();
            $rawData11 = \yii::$app->db->createCommand($sql11)->queryAll();
            $rawData12 = \yii::$app->db->createCommand($sql12)->queryAll();
            
            $rawData_sum1 = \yii::$app->db->createCommand($sql_sum1)->queryAll();
            $rawData_sum2 = \yii::$app->db->createCommand($sql_sum2)->queryAll();
            
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
             
               
        return $this->render('compare2', [
                    'rawData1' => $rawData1,  
                    'rawData2' => $rawData2,
                    'rawData3' => $rawData3, 
                    'rawData4' => $rawData4, 
                    'rawData5' => $rawData5,
                    'rawData6' => $rawData6,
            
                    'rawData7' => $rawData7,
                    'rawData8' => $rawData8,
                    'rawData9' => $rawData9,
                    'rawData10' => $rawData10,
                    'rawData11' => $rawData11,
                    'rawData12' => $rawData12,
                    
                    'rawData_sum1' => $rawData_sum1,
                    'rawData_sum2' => $rawData_sum2,
            
            
                    'report_name' => $report_name,
                    'sub_currency1' => $sub_currency1,
                    'sub_currency2' => $sub_currency2,
                    'sub_currency3' => $sub_currency3,
                    'sub_currency4' => $sub_currency4,
                    'sub_currency5' => $sub_currency5,
                    'sub_currency6' => $sub_currency6,
            
                    'sub_currency7' => $sub_currency7,
                    'sub_currency8' => $sub_currency8,
                    'sub_currency9' => $sub_currency9,
                    'sub_currency10' => $sub_currency10,
                    'sub_currency11' => $sub_currency11,
                    'sub_currency12' => $sub_currency12,
                    'datestart' => $datestart,
                    'dateend' => $dateend,
                     
        ]);  
    }
    

   
     public function actionMultipleformp() {
        $session = Yii::$app->session;
        return $this->render('//compare/multipleformp');
    }
    
    
    
    public function actionCompare3($datestart,$dateend,$sub_currency1,$sub_currency2,$sub_currency3,$sub_currency4,$sub_currency5,$sub_currency6,$timeframe) {
        
         $currency_table1 = $sub_currency1.$timeframe;
         $currency_table2 = $sub_currency2.$timeframe;
         $currency_table3 = $sub_currency3.$timeframe;
         $currency_table4 = $sub_currency4.$timeframe;
         $currency_table5 = $sub_currency5.$timeframe;
         $currency_table6 = $sub_currency6.$timeframe;
         
         $price_dynamic_table = "price_dynamic".$timeframe;
         
       
         $report_name = "กราฟเปรียบเทียบ P-Core  ระหว่างวันที่ $datestart ถึงวันที่ $dateend ";
                
         // sql find units in sub_current table
        $sql_find1 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency1' ";
        $sql_find2 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency2' ";
        $sql_find3 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency3' ";
        $sql_find4 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency4' ";
        $sql_find5 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency5' ";
        $sql_find6 = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency6' ";

        
              
        // sql find first open price @ first day select
        $sql_find_open_price_first1 = "SELECT open FROM $currency_table1 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first2 = "SELECT open FROM $currency_table2 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first3 = "SELECT open FROM $currency_table3 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first4 = "SELECT open FROM $currency_table4 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first5 = "SELECT open FROM $currency_table5 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        $sql_find_open_price_first6 = "SELECT open FROM $currency_table6 WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
     
        
        try {
            $data_unit1 = \yii::$app->db->createCommand($sql_find1)->queryAll();
            $data_unit2 = \yii::$app->db->createCommand($sql_find2)->queryAll();
            $data_unit3 = \yii::$app->db->createCommand($sql_find3)->queryAll();
            $data_unit4 = \yii::$app->db->createCommand($sql_find4)->queryAll();
            $data_unit5 = \yii::$app->db->createCommand($sql_find5)->queryAll();
            $data_unit6 = \yii::$app->db->createCommand($sql_find6)->queryAll();
      
            
            $data_open_price_first1 = \yii::$app->db->createCommand($sql_find_open_price_first1)->queryAll();
            $data_open_price_first2 = \yii::$app->db->createCommand($sql_find_open_price_first2)->queryAll();
            $data_open_price_first3 = \yii::$app->db->createCommand($sql_find_open_price_first3)->queryAll();
            $data_open_price_first4 = \yii::$app->db->createCommand($sql_find_open_price_first4)->queryAll();
            $data_open_price_first5 = \yii::$app->db->createCommand($sql_find_open_price_first5)->queryAll();
            $data_open_price_first6 = \yii::$app->db->createCommand($sql_find_open_price_first6)->queryAll();
       

            
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        
        $unit1 = $data_unit1[0]['units'];
        $unit2 = $data_unit2[0]['units'];
        $unit3 = $data_unit3[0]['units'];
        $unit4 = $data_unit4[0]['units'];
        $unit5 = $data_unit5[0]['units'];
        $unit6 = $data_unit6[0]['units'];
     
        
        // first open price @ date first selected
        $open_price_first1 = $data_open_price_first1[0]['open'];
        $open_price_first2 = $data_open_price_first2[0]['open'];
        $open_price_first3 = $data_open_price_first3[0]['open'];
        $open_price_first4 = $data_open_price_first4[0]['open'];
        $open_price_first5 = $data_open_price_first5[0]['open'];
        $open_price_first6 = $data_open_price_first6[0]['open'];
     

            
        // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql1 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first1 < t1.`OPEN`,t1.open-$open_price_first1,
                                    IF($open_price_first1 > t1.`open`, t1.open - $open_price_first1  , 1
                          )
                    )*$unit1 as price_range_1,
                        
                    IF($open_price_first1 < t1.`hight`,t1.hight-$open_price_first1,
                                    IF($open_price_first1 > t1.`hight`, t1.hight - $open_price_first1  , 1
                          )
                    )*$unit1 as price_range_1_hight,
                        
                     IF($open_price_first1 < t1.`low`,t1.low-$open_price_first1,
                                    IF($open_price_first1 > t1.`low`, t1.low - $open_price_first1  , 1
                          )
                    )*$unit1 as price_range_1_low
                                                             
                FROM $price_dynamic_table h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN`,hight,low from $currency_table1 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        

        
        // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql2 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first2 < t1.`OPEN`,t1.open-$open_price_first2,
                                    IF($open_price_first2 > t1.`open`, t1.open - $open_price_first2  , 1
                          )
                    )*$unit2 as price_range_2,
                        
                    IF($open_price_first2 < t1.`hight`,t1.hight-$open_price_first2,
                                    IF($open_price_first2 > t1.`hight`, t1.hight - $open_price_first2  , 1
                          )
                    )*$unit2 as price_range_2_hight,
                        
                     IF($open_price_first2 < t1.`low`,t1.low-$open_price_first2,
                                    IF($open_price_first2 > t1.`low`, t1.low - $open_price_first2  , 1
                          )
                    )*$unit2 as price_range_2_low
                        
                                                             
                FROM $price_dynamic_table h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN`,hight,low from $currency_table2 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
        // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql3 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first3 < t1.`OPEN`,t1.open-$open_price_first3,
                                    IF($open_price_first3 > t1.`open`, t1.open - $open_price_first3  , 1
                          )
                    )*$unit3 as price_range_3,
                        
                    IF($open_price_first3 < t1.`hight`,t1.hight-$open_price_first3,
                                    IF($open_price_first3 > t1.`hight`, t1.hight - $open_price_first3  , 1
                          )
                    )*$unit3 as price_range_3_hight,
                        
                    IF($open_price_first3 < t1.`low`,t1.low-$open_price_first3,
                                    IF($open_price_first3 > t1.`low`, t1.low - $open_price_first3  , 1
                          )
                    )*$unit3 as price_range_3_low
                        
                                                             
                FROM $price_dynamic_table h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN`,hight,low from $currency_table3 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
                // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql4 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first4 < t1.`OPEN`,t1.open-$open_price_first4,
                                    IF($open_price_first4 > t1.`open`, t1.open - $open_price_first4  , 1
                          )
                    )*$unit4 as price_range_4,
                    
                    IF($open_price_first4 < t1.`hight`,t1.hight-$open_price_first4,
                                    IF($open_price_first4 > t1.`hight`, t1.hight - $open_price_first4  , 1
                          )
                    )*$unit4 as price_range_4_hight,
                        
                    IF($open_price_first4 < t1.`low`,t1.low-$open_price_first4,
                                    IF($open_price_first4 > t1.`low`, t1.low - $open_price_first4  , 1
                          )
                    )*$unit4 as price_range_4_low
                        
                                                             
                FROM $price_dynamic_table h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN`,hight,low  from $currency_table4 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
         // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql5 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first5 < t1.`OPEN`,t1.open-$open_price_first5,
                                    IF($open_price_first5 > t1.`open`, t1.open - $open_price_first5  , 1
                          )
                    )*$unit5 as price_range_5,
                        
                    IF($open_price_first5 < t1.`hight`,t1.hight-$open_price_first5,
                                    IF($open_price_first5 > t1.`hight`, t1.hight - $open_price_first5  , 1
                          )
                    )*$unit5 as price_range_5_hight,
                        
                    IF($open_price_first5 < t1.`low`,t1.low-$open_price_first5,
                                    IF($open_price_first5 > t1.`low`, t1.low - $open_price_first5  , 1
                          )
                    )*$unit5 as price_range_5_low
                        
                                                             
                FROM $price_dynamic_table h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN`,hight,low  from $currency_table5 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
        
        // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql6 = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first6 < t1.`OPEN`,t1.open-$open_price_first6,
                                    IF($open_price_first6 > t1.`open`, t1.open - $open_price_first6  , 1
                          )
                    )*$unit6 as price_range_6,
                        
                    IF($open_price_first6 < t1.`hight`,t1.hight-$open_price_first6,
                                    IF($open_price_first6 > t1.`hight`, t1.hight - $open_price_first6  , 1
                          )
                    )*$unit6 as price_range_6_hight,
                        
                     IF($open_price_first6 < t1.`low`,t1.low-$open_price_first6,
                                    IF($open_price_first6 > t1.`low`, t1.low - $open_price_first6  , 1
                          )
                    )*$unit6 as price_range_6_low
                                                             
                FROM $price_dynamic_table h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN`,hight,low  from $currency_table6 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second  ";
        
        
      
        
          
                                            
        
         $sql_sum1 = "SELECT  date_s, time_second , sum(price_range_1) as sum_price_range1,sum(price_range_1_hight) as sum_price_range1_hight, sum(price_range_1_low) as sum_price_range1_low, sum(price_range_1)*-1 as sum_price_range1_inverse   FROM (

                             SELECT 
                                concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 

                                IF($open_price_first1 < t1.`OPEN`,t1.open-$open_price_first1,
                                                IF($open_price_first1 > t1.`open`, t1.open - $open_price_first1  , 1
                                      )
                                )*$unit1 as price_range_1,
                                 
                                IF($open_price_first1 < t1.`hight`,t1.hight-$open_price_first1,
                                                IF($open_price_first1 > t1.`hight`, t1.hight - $open_price_first1  , 1
                                      )
                                )*$unit1 as price_range_1_hight,
                                    
                                 IF($open_price_first1 < t1.`low`,t1.low-$open_price_first1,
                                    IF($open_price_first1 > t1.`low`, t1.low - $open_price_first1  , 1
                                        )
                                  )*$unit1 as price_range_1_low

                            FROM $price_dynamic_table h1

                            LEFT JOIN (
                                        select DATE_S,TIME_S,`OPEN`,hight,low from $currency_table1 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                            ) t1 on (t1.TIME_S = h1.time_second)


                            GROUP BY t1.DATE_S,h1.time_second

                    UNION ALL

                            SELECT 
                                concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 

                                IF($open_price_first2 < t1.`OPEN`,t1.open-$open_price_first2,
                                                IF($open_price_first2 > t1.`open`, t1.open - $open_price_first2  , 1
                                      )
                                )*$unit2 as price_range_1,
                                    
                                IF($open_price_first2 < t1.`hight`,t1.hight-$open_price_first2,
                                            IF($open_price_first2 > t1.`hight`, t1.hight - $open_price_first2  , 1
                                        )
                                    )*$unit2 as price_range_2_hight,
                                        

                                IF($open_price_first2 < t1.`low`,t1.low-$open_price_first2,
                                               IF($open_price_first2 > t1.`low`, t1.low - $open_price_first2  , 1
                                     )
                               )*$unit2 as price_range_2_low

                            FROM $price_dynamic_table h1

                            LEFT JOIN (
                                        select DATE_S,TIME_S,`OPEN`,hight,low from $currency_table2 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                            ) t1 on (t1.TIME_S = h1.time_second)

                            GROUP BY t1.DATE_S,h1.time_second
                            
                    
                UNION ALL


                    SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                        IF($open_price_first3 < t1.`OPEN`,t1.open-$open_price_first3,
                                        IF($open_price_first3 > t1.`open`, t1.open - $open_price_first3  , 1
                              )
                        )*$unit3 as price_range_1,
                            
                                           
                        IF($open_price_first3 < t1.`hight`,t1.hight-$open_price_first3,
                                        IF($open_price_first3 > t1.`hight`, t1.hight - $open_price_first3  , 1
                              )
                        )*$unit3 as price_range_3_hight,
                            
                        IF($open_price_first3 < t1.`low`,t1.low-$open_price_first3,
                                    IF($open_price_first3 > t1.`low`, t1.low - $open_price_first3  , 1
                                )
                          )*$unit3 as price_range_3_low
                        

                    FROM $price_dynamic_table h1

                    LEFT JOIN (
                                select DATE_S,TIME_S,`OPEN`,hight,low from $currency_table3 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                    ) t1 on (t1.TIME_S = h1.time_second)
                    
                    GROUP BY t1.DATE_S,h1.time_second
                    
                UNION ALL
                    
                    SELECT 
                        concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 

                        IF($open_price_first4 < t1.`OPEN`,t1.open-$open_price_first4,
                                        IF($open_price_first4 > t1.`open`, t1.open - $open_price_first4  , 1
                              )
                        )*$unit4 as price_range_1,
                            
                        IF($open_price_first4 < t1.`hight`,t1.hight-$open_price_first4,
                                    IF($open_price_first4 > t1.`hight`, t1.hight - $open_price_first4  , 1
                          )
                        )*$unit4 as price_range_4_hight, 
                            
                        IF($open_price_first4 < t1.`low`,t1.low-$open_price_first4,
                             IF($open_price_first4 > t1.`low`, t1.low - $open_price_first4  , 1
                                )
                          )*$unit4 as price_range_4_low
                        

                    FROM $price_dynamic_table h1

                    LEFT JOIN (
                                select DATE_S,TIME_S,`OPEN`,hight,low from $currency_table4 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                    ) t1 on (t1.TIME_S = h1.time_second)

                    GROUP BY t1.DATE_S,h1.time_second

                
                UNION ALL
                
                        SELECT 
                        concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 

                        IF($open_price_first5 < t1.`OPEN`,t1.open-$open_price_first5,
                                        IF($open_price_first5 > t1.`open`, t1.open - $open_price_first5  , 1
                              )
                        )*$unit5 as price_range_1,
                            
                        IF($open_price_first5 < t1.`hight`,t1.hight-$open_price_first5,
                                    IF($open_price_first5 > t1.`hight`, t1.hight - $open_price_first5  , 1
                          )
                        )*$unit5 as price_range_5_hight,
                            
                        IF($open_price_first5 < t1.`low`,t1.low-$open_price_first5,
                                    IF($open_price_first5 > t1.`low`, t1.low - $open_price_first5  , 1
                                )
                          )*$unit5 as price_range_5_low
                        


                    FROM $price_dynamic_table h1

                    LEFT JOIN (
                                select DATE_S,TIME_S,`OPEN`,hight,low from $currency_table5 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                    ) t1 on (t1.TIME_S = h1.time_second)
                    GROUP BY t1.DATE_S,h1.time_second
                    

            UNION ALL
                
                        SELECT 
                        concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 

                        IF($open_price_first6 < t1.`OPEN`,t1.open-$open_price_first6,
                                        IF($open_price_first6 > t1.`open`, t1.open - $open_price_first6  , 1
                              )
                        )*$unit6 as price_range_1,
                            
                        IF($open_price_first6 < t1.`hight`,t1.hight-$open_price_first6,
                                    IF($open_price_first6 > t1.`hight`, t1.hight - $open_price_first6  , 1
                              )
                        )*$unit6 as price_range_6_hight, 
                            
                          IF($open_price_first6 < t1.`low`,t1.low-$open_price_first6,
                                    IF($open_price_first6 > t1.`low`, t1.low - $open_price_first6  , 1
                                )
                          )*$unit6 as price_range_6_low
                        

                    FROM $price_dynamic_table h1

                    LEFT JOIN (
                                select DATE_S,TIME_S,`OPEN`,hight,low from $currency_table6 where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                    ) t1 on (t1.TIME_S = h1.time_second)
                    GROUP BY t1.DATE_S,h1.time_second
                    
                                            
                ) ts

                GROUP BY date_s,time_second    ";
                
                   
                
        
        try {
            $rawData1 = \yii::$app->db->createCommand($sql1)->queryAll();  
            $rawData2 = \yii::$app->db->createCommand($sql2)->queryAll();
            $rawData3 = \yii::$app->db->createCommand($sql3)->queryAll(); 
            $rawData4 = \yii::$app->db->createCommand($sql4)->queryAll();
            $rawData5 = \yii::$app->db->createCommand($sql5)->queryAll();
            $rawData6 = \yii::$app->db->createCommand($sql6)->queryAll();

        
            $rawData_sum1 = \yii::$app->db->createCommand($sql_sum1)->queryAll();

            
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
             
              
        return $this->render('compare3', [
                    'rawData1' => $rawData1,  
                    'rawData2' => $rawData2,
                    'rawData3' => $rawData3, 
                    'rawData4' => $rawData4, 
                    'rawData5' => $rawData5, 
                    'rawData6' => $rawData6, 
                    'rawData_sum1' => $rawData_sum1,
                    'report_name' => $report_name,
                    'sub_currency1' => $sub_currency1,
                    'sub_currency2' => $sub_currency2,
                    'sub_currency3' => $sub_currency3,
                    'sub_currency4' => $sub_currency4,
                    'sub_currency5' => $sub_currency5,
                    'sub_currency6' => $sub_currency6,
                    'datestart' => $datestart,
                    'dateend' => $dateend,
                     
        ]);  
    }
    
    
  

}

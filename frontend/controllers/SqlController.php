<?php
namespace frontend\controllers;
use Yii;
use frontend\components\CommonController;
class SqlController extends CommonController {
    
    public function actionReport1($sub_currency_id) {
        $currency_table = $sub_currency_id . "_mn";
        $report_name = "เลือกปีที่ต้องการดูข้อมูลสถิติของคู่เงิน $sub_currency_id";
        $sql = "SELECT 
                    YEAR(DATE_S) as year_s
                FROM $currency_table
                GROUP BY  YEAR(DATE_S)
                ORDER BY year_s DESC
                LIMIT 5 ";
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report1', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'sub_currency_id' => $sub_currency_id
        ]);
    }
    
    
    public function actionReport2($sub_currency_id, $year_s) {
        $currency_table = $sub_currency_id . "_mn";
               
        $report_name = "ข้อมูลสถิติการแกว่ง(Volatility) รายเดือนของคู่เงิน $sub_currency_id ปี ".$year_s;
        // sql find units in sub_current table
        $sql_find = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency_id' ";
        try {
            $data_unit = \yii::$app->db->createCommand($sql_find)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $unit = $data_unit[0]['units'];
        
        $sql = "SELECT 
                    '$sub_currency_id' as cur_name,
                    CONCAT(MONTH(DATE_S),'-',YEAR(DATE_S))  as month_s,
                    MONTH(DATE_S) as month_id,
                    open,hight,low,close,
                    ((hight-open)*$unit) as oh,
                    ((open-low)*$unit) as ol
                FROM $currency_table
                WHERE YEAR(DATE_S) = $year_s
                GROUP BY  CONCAT(YEAR(DATE_S),'-',MONTH(DATE_S))
                
                ORDER BY DATE_S ";
                                    
                            
             
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        
                    
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
              
            
        return $this->render('report2', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'sub_currency_id' => $sub_currency_id,
                    'year_s' => $year_s,
        ]);
    }
    
    
    public function actionReport3($sub_currency_id, $year_s) {
        $currency_table = $sub_currency_id . "_w1";
        $report_name = "ข้อมูลสถิติการแกว่ง(Volatility) รายสัปดาห์ ของคู่เงิน $sub_currency_id  ปี $year_s ";
        // sql find units in sub_current table
        $sql_find = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency_id' ";
        try {
            $data_unit = \yii::$app->db->createCommand($sql_find)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $unit = $data_unit[0]['units'];
        
     
        $sql = "SELECT 
              '$sub_currency_id' as cur_name,
               DATE_S as date_s,
               MONTH(DATE_S) as month_s,
               ((hight-open)*$unit) as oh,
               ((open-low)*$unit) as ol
         FROM $currency_table
         WHERE 
               YEAR(DATE_S) =  $year_s
         GROUP BY DATE_S ";
        
                                       
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
         
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        
        return $this->render('report3', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,                  
                    'report_name' => $report_name,
                    'sub_currency_id' => $sub_currency_id,
                    'year_s' => $year_s,

        ]);
    }
    
    public function actionReport4($sub_currency_id, $year_s) {
        $currency_table = $sub_currency_id . "_d1";
        $report_name = "กราฟพฤติกรรมการแกว่ง(Volatility) ของราคาในคู่เงิน $sub_currency_id  ปี $year_s ในกรอบระยะ 1 วัน";
        // sql find units in sub_current table
        $sql_find = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency_id' ";
        try {
            $data_unit = \yii::$app->db->createCommand($sql_find)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $unit = $data_unit[0]['units'];
 
        $sql = "SELECT 
               '$sub_currency_id' as cur_name,
                e.date_s,
               MONTH(e.date_s) as month_s,
               ((e.hight-e.open)*$unit) as oh,
               ((e.open-e.low)*$unit) as ol
            FROM $currency_table e      
            WHERE YEAR(e.DATE_S) = $year_s 
            AND e.DATE_S not in (select date_s from alldates where date_code in (0,1,6) )
            ORDER BY  ((e.hight-e.open)*$unit) DESC ";
        
        $sql2 = "SELECT 
               '$sub_currency_id' as cur_name,
                e.date_s,
               MONTH(e.date_s) as month_s,
               ((e.hight-e.open)*$unit) as oh,
               ((e.open-e.low)*$unit) as ol
            FROM $currency_table e      
            WHERE YEAR(e.DATE_S) = $year_s
            AND e.DATE_S not in (select date_s from alldates where date_code in (0,1,6) )    
            ORDER BY ((e.open-e.low)*$unit) DESC ";
                              
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll(); 
            $rawData2 = \yii::$app->db->createCommand($sql2)->queryAll(); 
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        
        $dataProvider2 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData2,
            'pagination' => FALSE,
        ]);
            
        return $this->render('report4', [
                    'dataProvider' => $dataProvider,  
                    'dataProvider2' => $dataProvider2,    
                    'rawData' => $rawData,
                    'rawData2' => $rawData2,
                    'report_name' => $report_name,
                    'sub_currency_id' => $sub_currency_id,
                    'year_s' => $year_s,
        ]);
    }
    
    
    public function actionReport5($sub_currency_id, $year_s) {
        $currency_table = $sub_currency_id . "_h4";
        $report_name = "ข้อมูลสถิติของคู่เงิน $sub_currency_id  ปี $year_s ";
        // sql find units in sub_current table
        $sql_find = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency_id' ";
        try {
            $data_unit = \yii::$app->db->createCommand($sql_find)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $unit = $data_unit[0]['units'];
         
        /*
        $sql_total = "SELECT 
                        time_s,price as price,sum(count_range) as sum_range FROM 
                        

                        (
                            SELECT tr.time_s,price_range.price,count(t.range1) as count_range
                            FROM price_range
                            INNER JOIN time_range tr ON tr.`level` = price_range.`level`
                            LEFT JOIN (
                            select case
                                   when ((hight-open)*1000)  between   0 and 300        then    '0-300' 
                                   when ((hight-open)*1000)  between  301 and 600 	then    '301-600'
                                   when ((hight-open)*1000)  between  601 and 900 	then    '601-900'
                                   when ((hight-open)*1000)  between  901 and 1200 	then    '901-1200'
                                   when ((hight-open)*1000)  between 1201 and 1500 	then 	'1201-1500'
                                   when ((hight-open)*1000)  between 1501 and 1800 	then 	'1501-1800'
                                   when ((hight-open)*1000)  between 1801 and 2100 	then 	'1801-2100'
                                   when ((hight-open)*1000)  between 2101 and 2400 	then 	'2101-2400'
                                  end
                                 as range1,TIME_S,DATE_S
                                   from usdjpy_h4 where YEAR(DATE_S)=$year_s AND MONTH(DATE_S)= 06
                            ) t ON (t.range1 = price_range.price and tr.time_s = t.TIME_S)  
                            group by tr.time_s,price_range.price
                            

                            UNION ALL
                            
                            SELECT tr.time_s,price_range.price,count(t2.range1) as count_range
                            FROM price_range
                            INNER JOIN time_range tr ON tr.`level` = price_range.`level`
                            LEFT JOIN (
                            select case
                                   when ((open-low)*1000)  between   0 and 300          then    '0-300' 
                                   when ((open-low)*1000)  between  301 and 600 	then    '301-600'
                                   when ((open-low)*1000)  between  601 and 900 	then    '601-900'
                                   when ((open-low)*1000)  between  901 and 1200 	then 	'901-1200'
                                   when ((open-low)*1000)  between 1201 and 1500 	then 	'1201-1500'
                                   when ((open-low)*1000)  between 1501 and 1800 	then 	'1501-1800'
                                   when ((open-low)*1000)  between 1801 and 2100 	then 	'1801-2100'
                                   when ((open-low)*1000)  between 2101 and 2400 	then 	'2101-2400'
                                  end
                                   as range1,TIME_S,DATE_S
                                   from usdjpy_h4 where YEAR(DATE_S)=$year_s AND MONTH(DATE_S)= 06
                            ) t2 ON (t2.range1 = price_range.price and tr.time_s = t2.TIME_S)  
                            group by tr.time_s,price_range.price
                        ) tt
                        GROUP BY time_s,price
                        ORDER BY sum_range desc "; */
        
        
        $sql_positive = "SELECT 
                    tr.time_s,price_range.price as price_range,
                    count(t.range1) as count_price_by_range,
                    concat(tr.time_s,' ',price_range.price) as title
                FROM price_range
                INNER JOIN time_range tr ON tr.`level` = price_range.`level`
                LEFT JOIN (
                    select case
                           when ((hight-open)*$unit)  between   0 and 300    then    '0-300' 
                           when ((hight-open)*$unit)  between  301 and 600   then    '301-600'
                           when ((hight-open)*$unit)  between  601 and 900   then    '601-900'
                           when ((hight-open)*$unit)  between  901 and 1200  then    '901-1200'
                           when ((hight-open)*$unit)  between 1201 and 1500  then    '1201-1500'
                           when ((hight-open)*$unit)  between 1501 and 1800  then    '1501-1800'
                           when ((hight-open)*$unit)  between 1801 and 2100  then    '1801-2100'
                           when ((hight-open)*$unit)  between 2101 and 2400  then    '2101-2400'
                    end
                       as range1,TIME_S,DATE_S
                       from $currency_table where YEAR(DATE_S)= $year_s 
                ) t ON (t.range1 = price_range.price and tr.time_s = t.TIME_S)  
                GROUP BY tr.time_s,price_range.price
                ORDER BY price_range.no,tr.time_s ";
        
        $sql_negative = "SELECT 
                    tr.time_s,price_range.price as price_range,
                    concat('-',count(t.range1)) as count_price_by_range,
                    concat(price_range.price,'  ',tr.time_s) as title
                FROM price_range
                INNER JOIN time_range tr ON tr.`level` = price_range.`level`
                LEFT JOIN (
                    select case
                           when ((low-open)*$unit)  between   -300 and -1    then    '0-300' 
                           when ((low-open)*$unit)  between  -600 and -301   then    '301-600'
                           when ((low-open)*$unit)  between  -900 and -601   then    '601-900'
                           when ((low-open)*$unit)  between  -1200 and -901  then    '901-1200'
                           when ((low-open)*$unit)  between -1500 and -1201  then    '1201-1500'
                           when ((low-open)*$unit)  between -1800 and -1501  then    '1501-1800'
                           when ((low-open)*$unit)  between -2100 and -1801  then    '1801-2100'
                           when ((low-open)*$unit)  between -2400 and -2101  then    '2101-2400'
                    end
                       as range1,TIME_S,DATE_S
                       from $currency_table where YEAR(DATE_S)= $year_s 
                ) t ON (t.range1 = price_range.price and tr.time_s = t.TIME_S)  
                GROUP BY tr.time_s,price_range.price
                ORDER BY price_range.no,tr.time_s ";
        
        try {
          //  $rawData = \yii::$app->db->createCommand($sql_total)->queryAll();
            $rawData_positive = \yii::$app->db->createCommand($sql_positive)->queryAll();
            $rawData_negative = \yii::$app->db->createCommand($sql_negative)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        
         
        /*
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]); */
        
        $dataProvider_positive = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData_positive,
            'pagination' => FALSE,
        ]);
        $dataProvider_negative = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData_negative,
            'pagination' => FALSE,
        ]);
        
      
        return $this->render('report5', [
                //    'dataProvider' => $dataProvider,
                    'dataProvider_positive' => $dataProvider_positive,
                    'dataProvider_negative' => $dataProvider_negative,
                 //   'rawData' => $rawData,
                    'rawData_positive' => $rawData_positive,
                    'rawData_negative' => $rawData_negative,
                    'report_name' => $report_name,
                    'sub_currency_id' => $sub_currency_id,
                    'year_s' => $year_s,
        ]);
         
         
    }
    
    
    
    
    public function actionReport6($sub_currency_id, $date_s) {
        $currency_table = $sub_currency_id . "_h1";
        $report_name = "ข้อมูลสถิติของคู่เงิน $sub_currency_id วันที่ $date_s ";
        // sql find units in sub_current table
        $sql_find = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency_id' ";
        try {
            $data_unit = \yii::$app->db->createCommand($sql_find)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $unit = $data_unit[0]['units'];
        $sql = "SELECT 
                    '$sub_currency_id' as cur_name,
                     DATE_S as date_s,
                     TIME_S as time_s,
                     open,hight,low,close,
                    ((hight-open)*$unit) as oh,
                    ((low-open)*$unit) as ol
                FROM $currency_table
                WHERE DATE_S = '$date_s'
              
                ORDER BY DATE_S  ";
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report6', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'sub_currency_id' => $sub_currency_id,
        ]);
    }
    
    
    public function actionReport7($datestart,$dateend,$sub_currency_id,$timeframe) {
        $currency_table = $sub_currency_id.$timeframe;
        $report_name = "กราฟพฤติกรรมการแกว่งในคู่เงิน $sub_currency_id ระหว่างวันที่ $datestart ถึงวันที่ $dateend";
        // sql find units in sub_current table
        $sql_find = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency_id' ";
        
        // เอาไว้ดึงช่วงวันที่ไปให้กราฟแสดงผล
        $sql = "SELECT 
                    '$sub_currency_id' as cur_name, DATE_S as date_s 
                FROM $currency_table
                WHERE DATE_S between '$datestart' and '$dateend'
                GROUP BY DATE_S
                ORDER BY DATE_S   ";
        
        try {
            $data_unit = \yii::$app->db->createCommand($sql_find)->queryAll();
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();  
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $unit = $data_unit[0]['units'];
                   
        
        return $this->render('report7', [
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'sub_currency_id' => $sub_currency_id,
                    'currency_table' => $currency_table,
                    'timeframe' => $timeframe,
                    'datestart' => $datestart,
                    'dateend' => $dateend,
                    'unit' => $unit,
        ]); 
    }
    
    
    
    public function actionReport8($datestart,$dateend,$sub_currency_id,$timeframe) {
        $currency_table = $sub_currency_id.$timeframe;
        $price_dynamic_table = "price_dynamic".$timeframe;
        
        $report_name = "กราฟพฤติกรรมการแกว่งในคู่เงิน $sub_currency_id ระหว่างวันที่ $datestart ถึงวันที่ $dateend";
       
        // sql find units in sub_current table
        $sql_find = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency_id' ";
        
        
        // sql find first open price @ first day select
        $sql_find_open_price_first = "SELECT open FROM $currency_table WHERE DATE_S = '$datestart' ORDER BY DATE_S LIMIT 0,1 ";
        
           
        try {
            $data_unit = \yii::$app->db->createCommand($sql_find)->queryAll();
            $data_open_price_first = \yii::$app->db->createCommand($sql_find_open_price_first)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        
        $unit = $data_unit[0]['units'];
        $open_price_first = $data_open_price_first[0]['open'];
        
            
        // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql = "SELECT 
                    concat(t1.DATE_S,'   time@ ', h1.time_second) as date_s,h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first < t1.`OPEN`,t1.open-$open_price_first,
                                    IF($open_price_first > t1.`open`, t1.open - $open_price_first  , 1
                          )
                    )*$unit as cal_price_range,
                        
                    IF($open_price_first < t1.HIGHT,t1.HIGHT-$open_price_first,
                                    IF($open_price_first > t1.HIGHT, t1.HIGHT - $open_price_first  , 1
                          )
                    )*$unit as cal_price_range_hight,
                        
                    IF($open_price_first < t1.LOW,t1.LOW-$open_price_first,
                                    IF($open_price_first > t1.LOW, t1.LOW - $open_price_first  , 1
                          )
                    )*$unit as cal_price_range_low,
                                               
                        
                    (IF($open_price_first < t1.`OPEN`,t1.open-$open_price_first,
                                    IF($open_price_first > t1.`open`, t1.open - $open_price_first  , 1
                          )
                    )*$unit)*-1 as cal_price_range_inverse
                        
                                                             
                FROM $price_dynamic_table h1
                
                LEFT JOIN (
                            select DATE_S,TIME_S,`OPEN`,HIGHT,LOW from $currency_table where DATE_S BETWEEN '$datestart'  AND '$dateend' 

                ) t1 on (t1.TIME_S = h1.time_second)


                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second ";
        
        
        
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();  
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
   
                
        return $this->render('report8', [
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'sub_currency_id' => $sub_currency_id,
                    'currency_table' => $currency_table,
                    'datestart' => $datestart,
                    'dateend' => $dateend,
                    'unit' => $unit,
        ]); 
    }
    
    
    public function actionReport9($datestart,$dateend,$timestart,$timeend,$sub_currency_id,$timeframe) {
        $currency_table = $sub_currency_id.$timeframe;
        $price_dynamic_table = "price_dynamic".$timeframe;
        
        if($timestart == '01:00:00') {
            $timestart = '00:00:00';
        }
        
        
        $report_name = "ระดับการแกว่งของราคาค่าเงิน $sub_currency_id ระหว่างวันที่ $datestart ถึงวันที่ $dateend ณ ช่วงเวลา $timestart ถึง $timeend (เวลาโบรค)";
               
        // sql find units in sub_current table
        $sql_find = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency_id' ";
        
        // sql find timezone in sub_current table
        $sql_timezone = "SELECT name,val FROM config WHERE name = 'timezone' ";
        
         // sql find first open price @ first day select
        $sql_find_open_price_first = "SELECT open FROM $currency_table WHERE DATE_S = '$datestart' and TIME_S = '$timestart' ORDER BY DATE_S LIMIT 0,1 ";
                   
        try {
            $data_unit = \yii::$app->db->createCommand($sql_find)->queryAll();
            $data_open_price_first = \yii::$app->db->createCommand($sql_find_open_price_first)->queryAll();
            $data_timezone = \yii::$app->db->createCommand($sql_timezone)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $unit = $data_unit[0]['units'];
        $open_price_first = $data_open_price_first[0]['open'];
        $timezone = $data_timezone[0]['val'];
        
        
        // เอาไว้ดึงข้อมูลไปแสดงในกราฟเพื่อหาค่าสูงสุด/ต่ำสุด ในช่วงเวลาที่เลือก
        $sql = "SELECT 
                    date_s,`OPEN`,max(HIGHT) as max_hight, min(LOW) as min_low,
                    (max(HIGHT)-`OPEN`)*$unit as oh, 
                    (`OPEN`-min(LOW))*$unit as ol
                FROM $currency_table
                WHERE 
                    DATE_S BETWEEN '$datestart' and '$dateend' and TIME_S BETWEEN '$timestart' and '$timeend'
                GROUP BY DATE_S ORDER BY oh DESC ";
        
          // เอาไว้ดึงข้อมูลไปแสดงในกราฟเพื่อหาค่าสูงสุด/ต่ำสุด ในช่วงเวลาที่เลือก
        $sql1 = "SELECT 
                    date_s,`OPEN`,max(HIGHT) as max_hight, min(LOW) as min_low,
                    (max(HIGHT)-`OPEN`)*$unit as oh, 
                    (`OPEN`-min(LOW))*$unit as ol
                FROM $currency_table
                WHERE 
                    DATE_S BETWEEN '$datestart' and '$dateend' and TIME_S BETWEEN '$timestart' and '$timeend'
                GROUP BY DATE_S ORDER BY ol DESC ";
        
        
        
         // เอาไว้ดึงข้อมูลไปแสดงในกราฟเพื่อดูพฤติกรรมราคา
        $sql2 = "SELECT 
                    date_add(concat(t1.DATE_S,' ',h1.time_second), interval $timezone HOUR ) as date_s,
 
                    h1.time_first,t1.open as price_open,h1.time_second, 
                                           
                    IF($open_price_first < t1.`OPEN`,t1.open-$open_price_first,
                                    IF($open_price_first > t1.`open`, t1.open - $open_price_first  , 1
                          )
                    )*$unit as cal_price_range,
                        
                    IF($open_price_first < t1.HIGHT,t1.HIGHT-$open_price_first,
                                    IF($open_price_first > t1.HIGHT, t1.HIGHT - $open_price_first  , 1
                          )
                    )*$unit as cal_price_range_hight,
                        
                    IF($open_price_first < t1.LOW,t1.LOW-$open_price_first,
                                    IF($open_price_first > t1.LOW, t1.LOW - $open_price_first  , 1
                          )
                    )*$unit as cal_price_range_low,
                                               
                        
                    (IF($open_price_first < t1.`OPEN`,t1.open-$open_price_first,
                                    IF($open_price_first > t1.`open`, t1.open - $open_price_first  , 1
                          )
                    )*$unit)*-1 as cal_price_range_inverse,
                        
                    (max(HIGHT)-`OPEN`)*$unit as oh, 
                    (min(LOW)-`OPEN`)*$unit as ol
                        
                                                             
                FROM $price_dynamic_table h1
                
                RIGHT JOIN (
                            SELECT 
                                DATE_S,TIME_S,`OPEN`,HIGHT,LOW 
                            FROM $currency_table WHERE DATE_S BETWEEN '$datestart'  AND '$dateend' 
                            AND  time_s BETWEEN '$timestart' and '$timeend'
				
                ) t1 on (t1.TIME_S = h1.time_second)
                
                AND h1.time_second BETWEEN '$timestart' and '$timeend'

                GROUP BY t1.DATE_S,h1.time_second
                ORDER BY t1.DATE_S,h1.time_second "; 
        
   
        
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();  
            $rawData1 = \yii::$app->db->createCommand($sql1)->queryAll();  
            $rawData2 = \yii::$app->db->createCommand($sql2)->queryAll();  
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        
            
         return $this->render('report9', [
                    'rawData' => $rawData,
                    'rawData1' => $rawData1,
                    'rawData2' => $rawData2,
                    'sub_currency_id' => $sub_currency_id,
                    'report_name' => $report_name,
        ]);
    }
    
    
    
    
    public function actionReport10($datestart,$dateend,$sub_currency_id,$timeframe) {
        $currency_table = $sub_currency_id.$timeframe;
        $price_dynamic_table = "price_dynamic".$timeframe;
               
        $report_name = "กราฟพฤติกรรมการแกว่ง(Volatility) ของราคาในคู่เงิน $sub_currency_id ระหว่างวันที่ $datestart ถึง $dateend ในกรอบชั่วโมง";
        // sql find units in sub_current table
        $sql_find = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency_id' ";
               
        // sql หาราคาเปิดของวันจันทร์
        $sql_find_open_price_monday = "SELECT e.open
                                      FROM $currency_table e
                                      LEFT JOIN alldates a ON a.date_s = e.date_s
                                      WHERE e.DATE_S BETWEEN $datestart and $dateend
                                      AND a.date_code = 1 ";
       
          // sql หาราคาเปิดของวันอังคาร
        $sql_find_open_price_tuesday = "SELECT e.open
                                      FROM $currency_table e
                                      LEFT JOIN alldates a ON a.date_s = e.date_s
                                      WHERE e.DATE_S BETWEEN $datestart and $dateend
                                      AND a.date_code = 2 ";
        
        // sql หาราคาเปิดของวันพุธ
        $sql_find_open_price_wednesday = "SELECT e.open
                                      FROM $currency_table e
                                      LEFT JOIN alldates a ON a.date_s = e.date_s
                                      WHERE e.DATE_S BETWEEN $datestart and $dateend
                                      AND a.date_code = 3 ";
        
            // sql หาราคาเปิดของวันพฤหัสบดี
        $sql_find_open_price_thursday = "SELECT e.open
                                      FROM $currency_table e
                                      LEFT JOIN alldates a ON a.date_s = e.date_s
                                      WHERE e.DATE_S BETWEEN $datestart and $dateend
                                      AND a.date_code = 4 ";
        
        // sql หาราคาเปิดของวันศุกร์
        $sql_find_open_price_friday = "SELECT e.open
                                      FROM $currency_table e
                                      LEFT JOIN alldates a ON a.date_s = e.date_s
                                      WHERE e.DATE_S BETWEEN $datestart and $dateend
                                      AND a.date_code = 5 ";
        
        
        try {
            $data_unit = \yii::$app->db->createCommand($sql_find)->queryAll();
            $data_open_price_monday = \yii::$app->db->createCommand($sql_find_open_price_monday)->queryAll();
            $data_open_price_tuesday = \yii::$app->db->createCommand($sql_find_open_price_tuesday)->queryAll();
            $data_open_price_wednesday = \yii::$app->db->createCommand($sql_find_open_price_wednesday)->queryAll();
            $data_open_price_thursday = \yii::$app->db->createCommand($sql_find_open_price_thursday)->queryAll();
            $data_open_price_friday = \yii::$app->db->createCommand($sql_find_open_price_friday)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $unit = $data_unit[0]['units'];
        $open_price_monday = $data_open_price_monday[0]['open'];
        $open_price_tuesday = $data_open_price_tuesday[0]['open'];
        $open_price_wednesday = $data_open_price_wednesday[0]['open'];
        $open_price_thursday = $data_open_price_thursday[0]['open'];
        $open_price_friday = $data_open_price_friday[0]['open'];
        
         //วันจันทร์   
        $sql = "SELECT 
               '$sub_currency_id' as cur_name,
               concat('วันจันทร์ที่ ',e.date_s,'เวลา ', e.time_s) as date_s,
               e.TIME_S as time_s,
               ((e.hight-e.open)*$unit) as oh,
               ((e.low-e.open)*$unit) as ol
            FROM $currency_table e
            LEFT JOIN alldates a ON a.date_s = e.date_s
            WHERE e.DATE_s  BETWEEN $datestart  AND $dateend AND a.date_code = 1 ";
        
          //วันอังคาร 
        $sql2 = "SELECT 
               '$sub_currency_id' as cur_name,
               concat('วันอังคารที่ ',e.date_s,'เวลา ', e.time_s) as date_s,
               e.TIME_S as time_s,
               ((e.hight-e.open)*$unit) as oh,
               ((e.low-e.open)*$unit) as ol
            FROM $currency_table e
            LEFT JOIN alldates a ON a.date_s = e.date_s
            WHERE e.DATE_s  BETWEEN $datestart  AND $dateend AND a.date_code = 2 ";
        
         //วันพุธ 
        $sql3 = "SELECT 
               '$sub_currency_id' as cur_name,
               concat('วันพุธที่ ',e.date_s,'เวลา ', e.time_s) as date_s,
               e.TIME_S as time_s,
               ((e.hight-e.open)*$unit) as oh,
               ((e.low-e.open)*$unit) as ol
            FROM $currency_table e
            LEFT JOIN alldates a ON a.date_s = e.date_s
            WHERE e.DATE_s  BETWEEN $datestart  AND $dateend AND a.date_code = 3 ";
        
        //วันพฤหัสบดี 
        $sql4 = "SELECT 
               '$sub_currency_id' as cur_name,
               concat('วันพฤหัสบดีที่ ',e.date_s,'เวลา ', e.time_s) as date_s,
               e.TIME_S as time_s,
               ((e.hight-e.open)*$unit) as oh,
               ((e.low-e.open)*$unit) as ol
            FROM $currency_table e
            LEFT JOIN alldates a ON a.date_s = e.date_s
            WHERE e.DATE_s  BETWEEN $datestart  AND $dateend AND a.date_code = 4 ";
        
                //วันศุกร์
        $sql5 = "SELECT 
               '$sub_currency_id' as cur_name,
               concat('วันศุกร์ที่ ',e.date_s,'เวลา ', e.time_s) as date_s,
               e.TIME_S as time_s,
               ((e.hight-e.open)*$unit) as oh,
               ((e.low-e.open)*$unit) as ol
            FROM $currency_table e
            LEFT JOIN alldates a ON a.date_s = e.date_s
            WHERE e.DATE_s  BETWEEN $datestart  AND $dateend AND a.date_code = 5 ";
        
        
   
        
        
             
        try {
            $rawData  = \yii::$app->db->createCommand($sql)->queryAll(); 
            $rawData2 = \yii::$app->db->createCommand($sql2)->queryAll(); 
            $rawData3 = \yii::$app->db->createCommand($sql3)->queryAll(); 
            $rawData4 = \yii::$app->db->createCommand($sql4)->queryAll(); 
            $rawData5 = \yii::$app->db->createCommand($sql5)->queryAll(); 
            

            
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        
        
        return $this->render('report10', [             
                    'rawData' =>  $rawData,
                    'rawData2' => $rawData2,
                    'rawData3' => $rawData3,
                    'rawData4' => $rawData4,
                    'rawData5' => $rawData5,               
                    'report_name' => $report_name,
                    'sub_currency_id' => $sub_currency_id,
                    'datestart' => $datestart,
                    'dateend' => $dateend,
        ]);
    }
    
    
}?>
<?php

namespace frontend\controllers;

use yii;
use yii\data\SqlDataProvider;


class BacktestController extends \yii\web\Controller {

    public function actionIndex() {
        $session = Yii::$app->session;
        return $this->render('//backtest/index');
    }
    
    
    public function actionBacktest1($datestart,$dateend,$sub_currency) {
        
         $currency_table = $sub_currency."_m1";
   
         
         $report_name = "กราฟ backtest ของค่าเงิน $sub_currency ระหว่างวันที่ $datestart ถึงวันที่ $dateend ";
                
         // sql find units in sub_current table
        $sql_find = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency' ";
   
        
        try {
            $data_unit = \yii::$app->db->createCommand($sql_find)->queryAll();        
         
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $unit = $data_unit[0]['units'];

            
        // เอาไว้ดึงข้อมูลไปแสดงในกราฟ
        $sql = "SELECT 
                    a1.DATE_S,

                    /* เวลาเริ่มต้น */
                    a1.TIME_S as time_to_start_ea,

                    /* ราคาเปิดแรก ที่เวลาเริ่มต้น*/
                    a1.`OPEN` as first_open,

                    /* ราคาเป้าหมายที่คำนวณ gap แล้ว*/
                    TRUNCATE(a1.`OPEN` + 0.0003,5) as cal_gap_pending_order,

                    /*  ราคาเวลาที่แตะ Pending */
                    tt.time_to_pending_order_start,
                    tt.price_on_pending_start,

                    /* ราคา @ จุด stop loss */
                    tt.price_on_pending_start - 0.0030 as price_on_stop_loss, 

                    /* ราคา @ จุด  tp */
                    tt.price_on_pending_start + 0.0020 as price_on_tp, 

                    /*  ระดับราคาสูงสุด ณ ช่วงคาบเวลา */ + 
                    tt2.time_at_hight_price,
                    tt2.price_at_hight ,

                    /*  ระดับราคาต่ำสุด ณ ช่วงคาบเวลา */
                    tt3.time_at_low_price,
                    tt3.price_at_low,

                    /*  ระดับราคาสุดท้ายตามช่วงเวลาที่กำหนด */
                    tt4.time_at_last_close_price,
                    tt4.price_at_last_close_price,

                    /*  คำนวณคะแนน */ 
                    /*  1. ตรวจสอบว่าแตะราคา Pending หรือเปล่า    
                        2. ตรวจสอบว่าแตะ ราคาไม่แตะ  STop Loss  
                        3. ตรวจสอบว่าราคาแตะ TP หรือเปล่า        */

                    if(tt.price_on_pending_start >= TRUNCATE(a1.`OPEN` + 0.0003,5),
                                            if(tt3.price_at_low > (tt.price_on_pending_start - 0.0030) ,
                                                            if(tt2.price_at_hight >= tt.price_on_pending_start + 0.0020, 200, 
                                                                            if(tt.price_on_pending_start < tt4.price_at_last_close_price, (tt4.price_at_last_close_price-tt.price_on_pending_start)*100000, (-tt4.price_at_last_close_price+tt.price_on_pending_start)*100000 )), 
                                                    -300) 
                            ,0) as cal_score





                    from eurusd_m1 a1


                    /* หาราคา Pending ณ ช่วงเวลานั้นๆ */
                    left join 
                    (
                                    select a2.DATE_S,a2.TIME_S as time_to_pending_order_start,a2.HIGHT as price_on_pending_start from eurusd_m1 a2 where a2.DATE_S between '2017-05-01' and '2017-05-02' 
                                                                    and a2.TIME_S BETWEEN '11:45:00' and '12:45:00'  and a2.HIGHT >= (select (a3.`OPEN` + 0.0003) from eurusd_m1 a3 
                                                                                                                                                                                                                                                                                                                                                    where a3.DATE_S = a2.DATE_S
                                                                                                                                                                                                                                                                                                                                                    and a3.TIME_S = '11:45:00' 
                                                                                                                                                                                                                                                                                                                                               limit 1
                                                                                                                                                                                                                                                                                                                                                    )
                                                              group by a2.DATE_S


                    ) tt on tt.DATE_S = a1.DATE_S



                    /* หาราคาสูงสุด ณ ช่วงเวลานั้นๆ */
                    left join 
                    (
                                    select a4.DATE_S,a4.TIME_S as time_at_hight_price,a4.HIGHT as price_at_hight from eurusd_m1 a4 where a4.DATE_S between '2017-05-01' and '2017-05-02' 
                                                                    and a4.TIME_S BETWEEN '11:45:00' and '17:55:00'  and a4.HIGHT = (select max(a5.hight) from eurusd_m1 a5
                                                                                                                                                                                                                                                                                                                                                    where a5.DATE_S = a4.DATE_S and a5.TIME_S BETWEEN '11:45:00' and '17:55:00'  																																						
                                                                                                                                                                                                                                                                                                                                              limit 1
                                                                                                                                                                                                                                                                                                                                                    )
                                                              group by a4.DATE_S


                    ) tt2 on tt2.DATE_S = a1.DATE_S



                    /* หาราคาต่ำสุด ณ ช่วงเวลานั้นๆ */
                    left join 
                    (
                                    select a6.DATE_S,a6.TIME_S as time_at_low_price,a6.LOW as price_at_low from eurusd_m1 a6 where a6.DATE_S between '2017-05-01' and '2017-05-02' 
                                                                    and a6.TIME_S BETWEEN '11:45:00' and '17:55:00'  and a6.LOW = (select min(a7.low) from eurusd_m1 a7
                                                                                                                                                                                                                                                                                                                                                    where a7.DATE_S = a6.DATE_S and a7.TIME_S BETWEEN '11:45:00' and '17:55:00'  																																						
                                                                                                                                                                                                                                                                                                                                              limit 1
                                                                                                                                                                                                                                                                                                                                                    )
                                                              group by a6.DATE_S


                    ) tt3 on tt3.DATE_S = a1.DATE_S




                    /*   หาราคาสุดท้าย  */
                    left join 
                    (
                                    select a8.DATE_S,a8.TIME_S as time_at_last_close_price,a8.`CLOSE` as price_at_last_close_price from eurusd_m1 a8 where a8.DATE_S between '2017-05-01' and '2017-05-02' 
                                                                    and a8.TIME_S = '17:55:00'  
                                                              group by a8.DATE_S		

                    ) tt4 on tt4.DATE_S = a1.DATE_S



                    WHERE a1.DATE_S between '2017-05-01' and '2017-05-02' and a1.TIME_S BETWEEN '11:45:00' and '17:55:00'
                    GROUP BY a1.DATE_S


                    ";
        
                      
        
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();  
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
                   
        return $this->render('backtest1', [
                    'rawData' => $rawData,
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'sub_currency' => $sub_currency,
                    'datestart' => $datestart,
                    'dateend' => $dateend,
                     
        ]);  
        
        
    }
    

}

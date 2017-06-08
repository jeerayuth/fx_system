<?php

namespace frontend\controllers;

use Yii;
use frontend\components\CommonController;

class SqlController extends CommonController {

    public function actionReport1($sub_currency_id) {
        
        $currency_table = $sub_currency_id."_mn";
            
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
    
     public function actionReport2($sub_currency_id,$year_s) {
        $currency_table = $sub_currency_id."_mn";
            
        $report_name = "ข้อมูลสถิติของคู่เงิน $sub_currency_id ปี $year_s";
                 
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
                    ((low-open)*$unit) as ol
                FROM $currency_table
                WHERE YEAR(DATE_S) = $year_s
                GROUP BY  CONCAT(YEAR(DATE_S),'-',MONTH(DATE_S))
                
                ORDER BY DATE_S
                          
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

      
        return $this->render('report2', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'sub_currency_id' => $sub_currency_id,
                    'year_s' => $year_s,
                  
        ]); 
     }
    
    
    public function actionReport3($sub_currency_id,$year_s,$month_id) {
        $currency_table = $sub_currency_id."_w1";
        
        $report_name = "ข้อมูลสถิติของคู่เงิน $sub_currency_id เดือน $month_id ปี $year_s ";
         
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
                    DATE_S as month_s,
                    open,hight,low,close,
                    ((hight-open)*$unit) as oh,
                    ((low-open)*$unit) as ol
                FROM $currency_table
                WHERE YEAR(DATE_S) = $year_s and MONTH(DATE_S) = $month_id
              
                ORDER BY DATE_S   ";
              
                
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
    
    
    
    
    
    
    
    
    
     
}
?>
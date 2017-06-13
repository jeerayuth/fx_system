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

    public function actionReport3($sub_currency_id, $year_s, $month_id) {
        $currency_table = $sub_currency_id . "_w1";

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
                    'month_id' => $month_id,
        ]);
    }

    public function actionReport4($sub_currency_id, $year_s, $month_id) {
        $currency_table = $sub_currency_id . "_d1";

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
                    DATE_S as date_s ,
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


        return $this->render('report4', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'sub_currency_id' => $sub_currency_id,
                    'year_s' => $year_s,
                    'month_id' => $month_id,
        ]);
    }

    public function actionReport5($sub_currency_id, $date_s, $year_s, $month_id) {
        $currency_table = $sub_currency_id . "_h4";

        $report_name = "ข้อมูลสถิติของคู่เงิน $sub_currency_id  เดือน $month_id ปี $year_s ";

        // sql find units in sub_current table
        $sql_find = "SELECT id,units FROM sub_currency WHERE id = '$sub_currency_id' ";

        try {
            $data_unit = \yii::$app->db->createCommand($sql_find)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $unit = $data_unit[0]['units'];

        $sql = "SELECT 
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
                       from $currency_table where YEAR(DATE_S)= $year_s AND MONTH(DATE_S)=$month_id
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
                       from $currency_table where YEAR(DATE_S)= $year_s AND MONTH(DATE_S)=$month_id
                ) t ON (t.range1 = price_range.price and tr.time_s = t.TIME_S)  

                GROUP BY tr.time_s,price_range.price
                ORDER BY price_range.no,tr.time_s ";




        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            $rawData_negative = \yii::$app->db->createCommand($sql_negative)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        $dataProvider_negative = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData_negative,
            'pagination' => FALSE,
        ]);


        return $this->render('report5', [
                    'dataProvider' => $dataProvider,
                    'dataProvider_negative' => $dataProvider_negative,
                    'rawData' => $rawData,
                    'rawData_negative' => $rawData_negative,
                    'report_name' => $report_name,
                    'sub_currency_id' => $sub_currency_id,
                    'year_s' => $year_s,
                    'month_id' => $month_id,
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

}

?>
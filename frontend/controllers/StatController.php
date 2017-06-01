<?php

namespace frontend\controllers;

use Yii;
use frontend\components\CommonController;

class StatController extends CommonController {

    public function actionReport1($controller, $pointer,$report_name) {
   
        $report_name = $report_name;
        $report_name2 = "ประวัติการใช้งานรายงาน";

        $sql = "SELECT
                    lg.controller,lg.report,lg.username,op.name as fullname,
                    COUNT(lg.username) AS count_use
                FROM lamaereportslog lg
                LEFT OUTER JOIN opduser op ON op.loginname = lg.username
                WHERE 
                    lg.controller = '$controller' AND report= '$pointer'
                GROUP BY lg.username ";
        
        $sql2 = "SELECT
                    lg.controller,lg.report,lg.username,op.name as fullname,
                    lg.viewlog
                  
                FROM lamaereportslog lg
                LEFT OUTER JOIN opduser op ON op.loginname = lg.username
                WHERE 
                    lg.controller = '$controller' AND report= '$pointer'
                ORDER BY lg.viewlog DESC
                ";
        

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
         
        return $this->render('report1', [
                    'dataProvider' => $dataProvider, 
                    'dataProvider2' => $dataProvider2, 
                    'rawData' => $rawData,  
                    'rawData2' => $rawData2,
                    'report_name' => $report_name,
                    'report_name2' => $report_name2,
                    //'details' => $details,
        ]);
    }

}

<?php

namespace frontend\controllers;


use Yii;
use frontend\components\CommonController;

class AccountController extends CommonController {
    
    public $dep_controller = 'account';
 
    public function actionReport1($datestart, $dateend, $details) {
       
        // save log
        $this->SaveLog($this->dep_controller, 'report1', $this->getSession());
        
        $report_name = "รายงานผู้ป่วยค้างชำระ";
        $sql = "SELECT
            concat(DAY(r.arrear_date),'/',MONTH(r.arrear_date),'/',(YEAR(r.arrear_date)+543)) as arrear_date_thai,
            r.arrear_date,r.arrear_time,r.hn,
            concat(p.pname,p.fname,'  ',p.lname) as ptname,
            r.amount,r.paid,o.pttype, t.name as pttype_name
        FROM rcpt_arrear r
        LEFT OUTER JOIN ovst o ON o.vn=r.vn
        LEFT OUTER JOIN patient p ON p.hn=r.hn
        LEFT OUTER JOIN pttype t ON t.pttype = o.pttype
        WHERE
             r.arrear_date BETWEEN $datestart and $dateend AND r.paid ='N'
        ORDER BY r.arrear_id ";
        

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
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

     
   

}

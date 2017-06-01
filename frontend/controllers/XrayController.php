<?php

namespace frontend\controllers;

use Yii;
use frontend\components\CommonController;

class XrayController extends CommonController {

    public $dep_controller = 'xray';

    public function actionReport1($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report1', $this->getSession());

        $report_name = "รายงานจำนวนครั้งการรายงานผล x-ray นอกเวลาราชการ";

        $sql = "SELECT
                    x.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name, 
                    concat(DAY(x.report_date),'/',MONTH(x.report_date),'/',(YEAR(x.report_date)+543)) as report_date,
                    x.request_time,
                    x.report_time,x.staff,
                    x.xray_items_code ,i.xray_items_name
                FROM xray_report x
                LEFT OUTER JOIN patient p ON p.hn = x.hn
                LEFT OUTER JOIN xray_items i on i.xray_items_code = x.xray_items_code
                WHERE
                (
                  x.report_date  BETWEEN $datestart and $dateend AND
                  x.report_date IN
                    (
                                select holiday_date from   holiday
                    )

                OR

                  x.report_date  BETWEEN $datestart and $dateend AND
                  x.report_date NOT IN
                    (
                                select holiday_date from   holiday
                    ) AND
                  (x.report_time > '16:01:01' OR x.report_time  BETWEEN '00:01:01' AND '07:59:59')
                  
                                     
                )  ";
                         

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

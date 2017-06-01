<?php

namespace frontend\controllers;
use Yii;
use frontend\components\CommonController;

class PhysicController extends CommonController {
    public $dep_controller = 'physic';

    public function actionReport1($datestart, $dateend, $details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report1', $this->getSession());

        $report_name = "รายงานจำนวนหัตถการงานกายภาพบำบัด";
        $sql = "SELECT 
                    o.icode,n.name,sum(o.qty) as count_use 
                FROM opitemrece o
                    left outer join nondrugitems n on n.icode = o.icode
                WHERE o.vstdate between $datestart and $dateend
                    and o.icode  in ('3007979','3007955', '3007956','3007962','3007964', '3007957','3007959', '3007969')
                GROUP BY o.icode
                ORDER BY count_use DESC ";
        

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

     
    public function actionReport2($datestart, $dateend, $details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report2', $this->getSession());

        $report_name = "รายงานสรุปจำนวนการรับบริการงานกายภาพบำบัด";
        $sql = "SELECT
                    v.pttype,pp.name as pttype_name,count(v.pttype) as count_pttype ,
                    sum(v.item_money) as sum_money
                FROM physic_main p
                    left outer join  physic_chronic c on c.physic_chronic_id = p.physic_chronic_id
                    left outer join  ovst o on o.vn = p.vn  
                    left outer join  patient t on t.hn = o.hn
                    left outer join  vn_stat v on v.vn = p.vn
                    left outer join  pttype pp on pp.pttype = o.pttype
                    left outer join  icd101 i on i.code = v.pdx
                WHERE
                    p.vstdate between $datestart and $dateend 
                GROUP BY v.pttype
                ORDER BY count_pttype desc";
        

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
                    'details' => $details,
        ]);
    }
   

}

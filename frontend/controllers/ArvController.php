<?php

namespace frontend\controllers;
use Yii;
use frontend\components\CommonController;

class ArvController extends CommonController {
    public $dep_controller = 'arv';

    public function actionReport1($datestart, $dateend, $details) {
        
        // save log
        $this->SaveLog($this->dep_controller, 'report1', $this->getSession());

        $report_name = "รายงานผู้ป่วยที่มีรหัสวินิจฉัย B24";
        $sql = "SELECT
                    v.vn,v.hn,v.vstdate,
                    concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vstdate_thai,
                    concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
                    v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5,
                    o.icode,concat(d.name,'(',d.units,')') as drug_name ,nd.name as non_drug_name,
                    o.qty,
                    du.shortlist

        FROM vn_stat v
        LEFT OUTER JOIN opitemrece o on o.vn = v.vn
        LEFT OUTER JOIN drugitems d on d.icode = o.icode
        LEFT OUTER JOIN drugusage du on du.drugusage = o.drugusage
        LEFT OUTER JOIN nondrugitems nd on nd.icode = o.icode
        LEFT OUTER JOIN patient pt on pt.hn = v.hn

        WHERE v.vstdate BETWEEN $datestart AND $dateend AND

        (
              (v.pdx = 'b24') or
              (v.dx0 = 'b24') or
              (v.dx1 = 'b24') or
              (v.dx2 = 'b24') or
              (v.dx3 = 'b24') or
              (v.dx4 = 'b24') or
              (v.dx5 = 'b24')
        )
        AND o.icode NOT LIKE '3%'

        ORDER BY v.hn,v.vn,v.vstdate  ";

       
       
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

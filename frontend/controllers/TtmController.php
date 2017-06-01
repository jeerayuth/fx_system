<?php

namespace frontend\controllers;
use Yii;
use frontend\components\CommonController;

class TtmController extends CommonController {
    
    public $dep_controller = 'ttm';

    public function actionReport1($datestart, $dateend, $details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report1', $this->getSession());

        $report_name = "รายงานจำนวนหัตถการงานแพทย์แผนไทย";
        $sql = "SELECT
                    h.health_med_treatment_subtype_name,
                    count(s.health_med_treatment_subtype_id)   AS count_treatment_subtype,
                    count(distinct(hs.hn))  as count_hn
                FROM health_med_service_treatment  s
                LEFT OUTER JOIN health_med_treatment_subtype h on h.health_med_treatment_subtype_id = s.health_med_treatment_subtype_id
                LEFT OUTER JOIN health_med_service hs on hs.health_med_service_id = s.health_med_service_id
                WHERE
                    s.health_med_service_id in
                    (
                        select ss.health_med_service_id from  health_med_service  ss
                        where ss.health_med_service_id  = s.health_med_service_id
                        and ss.service_date between $datestart and $dateend 
                    )
                GROUP BY s.health_med_treatment_subtype_id
                ORDER BY count_treatment_subtype desc ";
        

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

        $report_name = "รายงานสรุปจำนวนการรับบริการงานแพทย์แผนไทย";
        $sql = "SELECT 
                    h.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
                    s.health_med_service_type_name,h.service_time ,
                    concat(DAY(h.service_date),'/',MONTH(h.service_date),'/',(YEAR(h.service_date)+543)) as service_date,
                    t.health_med_treatment_type_name ,r.health_med_service_result_name
                FROM health_med_service  h   
                    left outer join patient p on p.hn = h.hn
                    left outer join health_med_service_type s on s.health_med_service_type_id = h.health_med_service_type_id
                    left outer join health_med_treatment_type   t on t.health_med_treatment_type_id = h.health_med_treatment_type_id
                    left outer join health_med_service_result r on r.health_med_service_result_id = h.health_med_service_result_id
                WHERE h.service_date between $datestart and $dateend  ";
        
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
    
    
    public function actionReport3($datestart, $dateend, $details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report3', $this->getSession());

        $report_name = "รายงานผู้มารับบริการที่มีการสั่งยาแพทย์แผนไทยแต่ไม่ได้ไปรับบริการที่แพทย์แผนไทย";
        $sql = "SELECT
                    o.hn ,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
                    concat(i.name,' ',i.strength,' x ',i.packqty,' ',i.units) as drug_name,
                    o.qty, d.name as doctor_name,
                    concat(DAY(o.vstdate),'/',MONTH(o.vstdate),'/',(YEAR(o.vstdate)+543)) as vstdate
                FROM opitemrece  o
                    left outer join patient p on p.hn = o.hn
                    left outer join doctor d on d.code = o.doctor
                    left outer join drugitems i on i.icode = o.icode
                WHERE o.vstdate BETWEEN $datestart and $dateend  AND

                o.vn != '' and   (o.icode in

                (
                       select  d.icode from  drugitems d
                        where d.icode = o.icode and did like '4%'
                )

                and o.vn not in

                (
                      select  h.vn  from health_med_service  h
                      where h.vn = o.vn
                )

                )
                
                GROUP BY o.vn ";
        
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
                    'details' => $details,
        ]);
    }
   
    public function actionReport4($datestart, $dateend, $details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report4', $this->getSession());

        $report_name = "รายงานมูลค่าการสั่งใช้ยาแพทย์แผนไทยทั้งหมด";
        $report_name_graph = "รายงาน 10 อันดับมูลค่าการสั่งใช้ยาแพทย์แผนไทย";
         
        $sql = "SELECT
                    o.icode,d.name as drug_name,sum(o.qty) as sum_qty,
                     sum(o.sum_price) as sum_price,
                     sum(o.cost * o.qty ) as sum_cost,
                     count(distinct(o.hn)) as count_hn,
                     count(o.hn) as count_useage
                FROM opitemrece o
                LEFT OUTER JOIN drugitems d ON d.icode = o.icode
                WHERE 
                    o.vstdate BETWEEN $datestart and $dateend  AND 
                    d.did like '4%'
                GROUP BY o.icode
                ORDER BY sum_price DESC ";
        
        $sql_graph = "SELECT
                    o.icode,d.name as drug_name,sum(o.qty) as sum_qty,
                     sum(o.sum_price) as sum_price
                FROM opitemrece o
                LEFT OUTER JOIN drugitems d ON d.icode = o.icode
                WHERE 
                    o.vstdate BETWEEN $datestart and $dateend  AND 
                    d.did like '4%'
                GROUP BY o.icode
                ORDER BY sum_price DESC
                LIMIT 10 ";
        

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            $rawData_graph = \yii::$app->db->createCommand($sql_graph)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        
        $dataProvider_graph = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData_graph,
            'pagination' => FALSE,
        ]);

        return $this->render('report4', [
                    'dataProvider' => $dataProvider,
                    'dataProvider_graph' => $dataProvider_graph,
                    'rawData' => $rawData,
                    'rawData_graph' => $rawData_graph,
                    'report_name' => $report_name,
                    'report_name_graph' => $report_name_graph,
                    'details' => $details,
        ]);
    }
    
    
    public function actionReport5($datestart, $dateend, $details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report5', $this->getSession());

        $report_name = "รายงานมูลค่าการสั่งใช้ยาแพทย์แผนไทยทั้งหมดแยกตามแพทย์ผู้สั่ง";
        $report_name_graph = "รายงาน 10 อันดับมูลค่าการสั่งใช้ยาแพทย์แผนไทยแยกตามแพทย์ผู้สั่ง";      
        $sql = "SELECT
                       doc.name as doctor_name,sum(o.qty) as sum_qty,
                       sum(o.sum_price) as sum_price,
                       count(distinct(o.hn)) as count_hn,
                       count(distinct(o.vn)) as count_visit ,
                       count(o.hn) as count_useage
                 FROM opitemrece o
                 LEFT OUTER JOIN drugitems d ON d.icode = o.icode
                 LEFT OUTER JOIN doctor doc ON doc.code = o.doctor
                 WHERE o.vstdate BETWEEN $datestart and $dateend  AND d.did like '4%'
                 GROUP BY o.doctor
                 ORDER BY sum_price DESC ";
        
        $sql_graph = "SELECT
                        doc.name as doctor_name,sum(o.qty) as sum_qty,
                        sum(o.sum_price) as sum_price
                 FROM opitemrece o
                 LEFT OUTER JOIN drugitems d ON d.icode = o.icode
                 LEFT OUTER JOIN doctor doc ON doc.code = o.doctor
                 WHERE o.vstdate BETWEEN $datestart and $dateend  AND d.did like '4%'
                 GROUP BY o.doctor
                 ORDER BY sum_price DESC
                 LIMIT 10 ";
        
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            $rawData_graph = \yii::$app->db->createCommand($sql_graph)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        
        $dataProvider_graph = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData_graph,
            'pagination' => FALSE,
        ]);

        return $this->render('report5', [
                    'dataProvider' => $dataProvider,
                    'dataProvider_graph' => $dataProvider_graph,
                    'rawData' => $rawData,
                    'rawData_graph' => $rawData_graph,
                    'report_name' => $report_name,
                    'report_name_graph' => $report_name_graph,
                    'details' => $details,
        ]);
    }
    
    
    public function actionReport6($datestart, $dateend, $details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report6', $this->getSession());

        $report_name = "รายงานมูลค่าการสั่งใช้ยาแพทย์แผนไทยทั้งหมดแยกตามสิทธิ์การรักษา";
        $report_name_graph = "รายงาน 10 อันดับมูลค่าการสั่งใช้ยาแพทย์แผนไทยแยกตามสิทธิ์การรักษา ";      
        $sql = "SELECT
                     o.pttype,pt.name as pt_type_name,
                     sum(o.qty) as sum_qty,
                     sum(o.sum_price) as sum_price  ,
                     count(distinct(o.hn)) as count_hn,
                     count(o.hn) as count_useage
                 FROM opitemrece o
                 LEFT OUTER JOIN drugitems d ON d.icode = o.icode
                 LEFT OUTER JOIN pttype pt ON pt.pttype = o.pttype
                 WHERE o.vstdate BETWEEN $datestart and $dateend  AND d.did like '4%'
                 GROUP BY o.pttype 
                 ORDER BY sum_price DESC ";
        
        $sql_graph = "SELECT
                     o.pttype,pt.name as pt_type_name,
                     sum(o.qty) as sum_qty,
                     sum(o.sum_price) as sum_price 
                 FROM opitemrece o
                 LEFT OUTER JOIN drugitems d ON d.icode = o.icode
                 LEFT OUTER JOIN pttype pt ON pt.pttype = o.pttype
                 WHERE o.vstdate BETWEEN $datestart and $dateend  AND d.did like '4%'
                 GROUP BY o.pttype 
                 ORDER BY sum_price DESC 
                 LIMIT 10 ";
        
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            $rawData_graph = \yii::$app->db->createCommand($sql_graph)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        
        $dataProvider_graph = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData_graph,
            'pagination' => FALSE,
        ]);
    
        return $this->render('report6', [
                    'dataProvider' => $dataProvider,
                    'dataProvider_graph' => $dataProvider_graph,
                    'rawData' => $rawData,
                    'rawData_graph' => $rawData_graph,
                    'report_name' => $report_name,
                    'report_name_graph' => $report_name_graph,
                    'details' => $details,
        ]); 
    }


    

}

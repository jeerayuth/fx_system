<?php

namespace frontend\controllers;

use Yii;
use frontend\components\CommonController;

class EmergenController extends CommonController {

    public $dep_controller = 'emergen';

    public function actionReport1($datestart, $dateend, $details) {

        // save log
        $this->SaveLog($this->dep_controller, 'report1', $this->getSession());


        $report_name = "รายงานจำนวนครั้งในการใช้ยา TRCS";
        $sql = "SELECT
      op.icode,COUNT(distinct(op.vn)) AS total_usage,concat(dr.name,' ',dr.strength,' ',dr.units) AS drugname
FROM
    opitemrece op
    
LEFT OUTER JOIN drugitems dr ON dr.icode = op.icode
WHERE
     op.icode
     IN ('1540018','1540019','1540020','1540021','1540022','1540023','1540024','1540025','1540026','1540029')
AND
     op.vstdate BETWEEN $datestart and $dateend AND vn!=''
GROUP BY op.icode
ORDER BY total_usage DESC ";

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
                    'details' => $details,
        ]);
    }

    public function actionReport2($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report2', $this->getSession());


        $report_name = "รายงานจำนวนครั้งในการใช้ยา PCEC";
        $sql = "SELECT
      op.icode,COUNT(op.vn) AS total_usage,concat(dr.name,' ',dr.strength,' ',dr.units) AS drugname
FROM
    opitemrece op
LEFT OUTER JOIN drugitems dr ON dr.icode = op.icode
WHERE
     op.icode
     IN ( '1540061','1540062','1540058','1540059','1540060',
          '1540057','1540047','1540048','1540049','1540050',
          '1540054','1540055','1540056','1540061','1540062',
          '1540063','1540064','1540046','1540051','1540052',
          '1540053')
AND
     op.vstdate BETWEEN $datestart and $dateend AND vn!=''
GROUP BY op.icode
ORDER BY total_usage DESC ";

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
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport3($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report3', $this->getSession());


        $report_name = "รายงานจำนวนครั้งในการใช้ยา TETANUS";
        $sql = "SELECT
      op.icode,COUNT(op.vn) AS total_usage,concat(dr.name,' ',dr.strength,' ',dr.units) AS drugname
FROM
    opitemrece op
LEFT OUTER JOIN drugitems dr ON dr.icode = op.icode
WHERE
     op.icode
     IN ('1000295', '1580009', '1580010', '1580011')
AND
     op.vstdate BETWEEN $datestart and $dateend AND vn!=''
GROUP BY op.icode
ORDER BY total_usage DESC ";

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
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport4($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report4', $this->getSession());


        $report_name = "รายงานป้องกันและแก้ไขปัญหาอุบัติเหตุทางถนน";
        $sql = "select pt.hn,concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,er.vstdate

from er_regist er

left outer join vn_stat v on v.vn = er.vn
left outer join patient pt on pt.hn = v.hn

where er.vstdate between $datestart and $dateend    and

er.vn in

(
   select nu.vn from  er_nursing_detail nu where nu.vn = er.vn  and
   nu.er_accident_type_id=1
)";

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
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport5($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report5', $this->getSession());


        $report_name = "รายงานผู้ป่วยที่รับบริการที่ห้องฉุกเฉิน";
        $sql = "select 

                vs.vn as vn,vs.item_money as item_money,e.*,
                ert.name as emergency_name,erc.name as dch_name,
                o.icd10 as icd10,v.hn,v.vsttime,v.spclty as spclty,
                concat(p.pname,p.fname,'  ',p.lname) as pt_name,
                ep.name as period_name,d.name as doctor_name,
                k.department as name_department,
                erv.er_emergency_level_name,
                vs.pttype,
                ptt.name as pttype_name,
                SUBSTR(erp.name,3,200) as er_pt_type_name,
                spt.name as spclty_name

                from er_regist  e 
                    left outer join ovst v on v.vn=e.vn 
                    left outer join er_emergency_type ert on ert.er_emergency_type=e.er_emergency_type 
                    left outer join er_emergency_level erv on erv.er_emergency_level_id = e.er_emergency_level_id
                    left outer join er_dch_type erc on erc.er_dch_type=e.er_dch_type 
                    left outer join ovstdiag o on o.vn = e.vn and o.diagtype='1'
                    left outer join kskdepartment k on k.depcode =v.main_dep 
                    left outer join patient p on p.hn=v.hn 
                    left outer join er_period ep on ep.er_period=e.er_period 
                    left outer join doctor d on d.code= e.er_doctor 
                    left outer join vn_stat vs on vs.vn= e.vn 
                    left outer join pttype ptt on ptt.pttype = vs.pttype
                    left outer join er_pt_type erp on erp.er_pt_type = e.er_pt_type
                    left outer join spclty spt on spt.spclty = v.spclty
                    
                where e.vstdate between $datestart and $dateend order by e.vn ";


        $sql2 = " select
                ert.name as emergen_type, count(distinct(e.vn))   as count_vn            
                from er_regist  e                       
                left outer join er_emergency_type ert on ert.er_emergency_type=e.er_emergency_type 
                where e.vstdate between $datestart and $dateend 
                 group by   e.er_emergency_type
                 order by count(distinct(e.vn)) desc ";


        $sql3 = "select
                erv.er_emergency_level_name as emergen_level, count(distinct(e.vn))   as count_vn           
                from er_regist  e                       
                left outer join er_emergency_level erv on erv.er_emergency_level_id = e.er_emergency_level_id
                where e.vstdate between $datestart and $dateend 
                 group by   e.er_emergency_level_id
                 order by count(distinct(e.vn)) desc ";

        $sql4 = "select
                    'เวรดึก' as textname, count(distinct(e.vn))   as count_vn
                   from er_regist  e                       

                   left outer join ovst ov on ov.vn = e.vn


                    where e.vstdate between $datestart and $dateend  and vsttime between '00:01:01' and '07:59:59'

                    group by    textname

                union
                
                select
                    'เวรเช้า' as textname, count(distinct(e.vn))   as count_vn
                    from er_regist  e                       

                    left outer join ovst ov on ov.vn = e.vn

                     where e.vstdate between $datestart and $dateend  and vsttime between '08:00:01' and '16:00:00'

                     group by   textname

                union

                select
                    'เวรบ่าย' as textname, count(distinct(e.vn))   as count_vn
                    from er_regist  e                       

                    left outer join ovst ov on ov.vn = e.vn

                     where e.vstdate between $datestart and $dateend  and vsttime between '16:00:01' and '23:59:59'

                     group by   textname
";

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            $rawData2 = \yii::$app->db->createCommand($sql2)->queryAll();
            $rawData3 = \yii::$app->db->createCommand($sql3)->queryAll();
            $rawData4 = \yii::$app->db->createCommand($sql4)->queryAll();
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

        $dataProvider3 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData3,
            'pagination' => FALSE,
        ]);

        $dataProvider4 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData4,
            'pagination' => FALSE,
        ]);

        return $this->render('report5', [
                    'dataProvider' => $dataProvider,
                    'dataProvider2' => $dataProvider2,
                    'dataProvider3' => $dataProvider3,
                    'dataProvider4' => $dataProvider4,
                    'rawData2' => $rawData2,
                    'rawData3' => $rawData3,
                    'rawData4' => $rawData4,
                    'report_name' => $report_name,
                    'details' => $details,
                    'datestart' => $datestart,
                    'dateend' => $dateend,
        ]);
    }

    public function actionReport6($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report6', $this->getSession());


        $report_name = "อันดับโรคที่พบบ่อยที่ห้องอุบัติเหตุฉุกเฉิน";
        $sql = " select o.icd10 as icd10,ic.name as icd_name,ic.tname,count(o.icd10) as count_all
from er_regist e
left outer join ovstdiag o on o.vn = e.vn and o.diagtype='1'
left outer join icd101 ic on ic.code = o.icd10

where e.vstdate between $datestart and $dateend 
group by o.icd10    order by count_all desc
limit 40 ";

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
                    'details' => $details,
        ]);
    }

    public function actionReport7($rxtime_id, $datestart, $dateend, $details) {

        // save log
        $this->SaveLog($this->dep_controller, 'report7', $this->getSession());


        $rxtime = "";
        $work = "";

        if ($rxtime_id != '') {
            if ($rxtime_id == 1) {
                $report_name = "รายงานอันดับการสั่งใช้ยานอกเวลาที่ห้องอุบัติเหตุฉุกเฉิน(ช่วงเวลา 16.00น. ถึง 24.00น.)";
                $rxtime = " '16:00:01' and '23:59:59' ";
            } else if ($rxtime_id == 2) {
                $report_name = "รายงานอันดับการสั่งใช้ยานอกเวลาที่ห้องอุบัติเหตุฉุกเฉิน(ช่วงเวลา 20.00น. ถึง 24.00น.)";
                $rxtime = " '20:00:01' and '23:59:59' ";
            } else if ($rxtime_id == 3) {
                $report_name = "รายงานอันดับการสั่งใช้ยานอกเวลาที่ห้องอุบัติเหตุฉุกเฉิน(ช่วงเวลา 00.00น. ถึง 08.00น.)";
                $rxtime = " '00:00:01' and '07:59:59' ";
            }
        }


        $sql = "SELECT
                    o.icode,d.name as drug_name,sum(o.qty) as sum_qty

                FROM opitemrece    o
                    left outer join patient p on p.hn = o.hn
                    left outer join vn_stat v on v.vn = o.vn
                    left outer join opdscreen c on c.vn = o.vn
                    left outer join drugitems d on d.icode = o.icode
                    left outer join nondrugitems nd on nd.icode = o.icode
                WHERE o.rxdate between $datestart and $dateend  and o.rxtime between $rxtime

                    and o.vn is   not null
                   
                    and o.icode like '1%'
                    and o.vn in
                        (
                            select vn from er_regist
                        )
                GROUP BY  o.icode
                ORDER BY  sum_qty  desc ";


        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);


        return $this->render('report7', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport8($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report8', $this->getSession());

        $report_name = "รายงานอันดับการสั่งใช้ยานอกเวลา(16.00น.-07.59น.)ที่ห้องอุบัติเหตุฉุกเฉิน (เฉพาะวันหยุดราชการ)";
        $sql = "SELECT
                    o.icode,d.name as drug_name,sum(o.qty) as sum_qty
                FROM opitemrece    o
                    left outer join patient p on p.hn = o.hn
                    left outer join vn_stat v on v.vn = o.vn
                    left outer join opdscreen c on c.vn = o.vn
                    left outer join drugitems d on d.icode = o.icode
                    left outer join nondrugitems nd on nd.icode = o.icode
                WHERE o.vstdate between $datestart and $dateend
                    and (o.rxtime between '16:00:01' and '23:59:59' or o.rxtime between '00:00:01' and '07:59:59')
                    and o.vn is   not null
                    and o.vstdate  in
                        (
                            select holiday_date from holiday
                        )  
                    and o.icode like '1%'
                    and o.vn in
                        (
                            select vn from er_regist
                        )
                GROUP BY  o.icode
                ORDER BY  sum_qty  desc ";

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('report8', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport9($refer_type_id, $datestart, $dateend, $details) {

        // save log
        $this->SaveLog($this->dep_controller, 'report9', $this->getSession());


        $report_name = "รายงานสรุปอันดับโรคส่ง Refer ที่ห้องอุบัติเหตุฉุกเฉิน";

        $refer = '';

        if ($refer_type_id == 'all') {
            $refer = '';
        } else if ($refer_type_id == 1) {
            $refer = ' and ro.refer_type =  1 ';
        } else if ($refer_type_id == 2) {
            $refer = ' and ro.refer_type =  2 ';
        } else if ($refer_type_id == 0) {
            $refer = ' and ro.refer_type =  0 ';
        }

        $sql = "SELECT
                    ro.pdx,count(distinct(ro.vn)) as count_vn
                FROM referout ro
                    left outer join ovst o on o.vn = ro.vn
                    left outer join patient p on p.hn=ro.hn
                    left outer join hospcode h on h.hospcode = ro.hospcode
                    left outer join rfrcs r on r.rfrcs = ro.rfrcs
                    left outer join refer_point_list rfp on rfp.name = ro.refer_point 
                    left outer join kskdepartment ks on ks.depcode = ro.depcode
                    left outer join doctor d on d.code = ro.doctor
                    left outer join pttype pe on pe.pttype = o.pttype
                    left outer join icd101 ic on ic.code = ro.pdx
                    left outer join refer_type rt on rt.refer_type = ro.refer_type
                    left outer join refer_response_type rp on rp.refer_response_type_id = ro.refer_response_type_id
                    left outer join hospcode hp on hp.hospcode = ro.refer_hospcode

                WHERE   ro.department = 'OPD' 
                        and ro.refer_date between $datestart and $dateend 
                            $refer
                        and ro.depcode='009'
                        and ro.pdx != ''
                GROUP BY ro.pdx
                ORDER BY count_vn DESC 
                LIMIT 50 ";


        $sql2 = "SELECT
                    d.name as doctor_name,ro.pdx as pdx,if(ro.confirm_text!='',ro.confirm_text,'-') as confirm_text,
                    ro.refer_hospcode, concat(hp.hosptype,' ',hp.name) as refer_hospname,
                    rp.refer_response_type_name,rt.refer_type_name,ro.department,ro.vn,
                    ro.refer_number,ro.rfrcs,ro.refer_response_type_id,ro.hn,
                    rfp.name as refer_point_name,ro.pre_diagnosis,d.name as doctor_name,
                    ro.refer_number,ks.department as department_name,ro.other_text,
                    concat(DAY(ro.refer_date),'/',MONTH(ro.refer_date),'/',(YEAR(ro.refer_date)+543)) as refer_date,
                    o.vstdate,ro.refer_time,o.vsttime,concat(p.pname,p.fname,'  ',p.lname) as ptname,  
                    concat(h.hosptype,' ',h.name) as hospname,pe.name as pttype_name,
                    r.name as refername, ro.refer_point,ro.pre_diagnosis,ro.pdx as icd,
                    ic.name as icd_name ,o.vstdate
                FROM referout ro
                    left outer join ovst o on o.vn = ro.vn
                    left outer join patient p on p.hn=ro.hn
                    left outer join hospcode h on h.hospcode = ro.hospcode
                    left outer join rfrcs r on r.rfrcs = ro.rfrcs
                    left outer join refer_point_list rfp on rfp.name = ro.refer_point 
                    left outer join kskdepartment ks on ks.depcode = ro.depcode
                    left outer join doctor d on d.code = ro.doctor
                    left outer join pttype pe on pe.pttype = o.pttype
                    left outer join icd101 ic on ic.code = ro.pdx
                    left outer join refer_type rt on rt.refer_type = ro.refer_type
                    left outer join refer_response_type rp on rp.refer_response_type_id = ro.refer_response_type_id
                    left outer join hospcode hp on hp.hospcode = ro.refer_hospcode
               
                WHERE   
                    ro.department = 'OPD' 
                    and ro.refer_date between $datestart and $dateend  
                        $refer
                    and  ro.depcode='009' ";


        $sql3 = "SELECT
                    ro.pre_diagnosis,count(distinct(ro.vn)) as count_vn
                FROM referout ro
                    left outer join ovst o on o.vn = ro.vn
                    left outer join patient p on p.hn=ro.hn
                    left outer join hospcode h on h.hospcode = ro.hospcode
                    left outer join rfrcs r on r.rfrcs = ro.rfrcs
                    left outer join refer_point_list rfp on rfp.name = ro.refer_point 
                    left outer join kskdepartment ks on ks.depcode = ro.depcode
                    left outer join doctor d on d.code = ro.doctor
                    left outer join pttype pe on pe.pttype = o.pttype
                    left outer join icd101 ic on ic.code = ro.pdx
                    left outer join refer_type rt on rt.refer_type = ro.refer_type
                    left outer join refer_response_type rp on rp.refer_response_type_id = ro.refer_response_type_id
                    left outer join hospcode hp on hp.hospcode = ro.refer_hospcode

                WHERE   ro.department = 'OPD' 
                        and ro.refer_date between $datestart and $dateend 
                            $refer
                        and ro.depcode='009'
                        and ro.pre_diagnosis != ''
                GROUP BY ro.pre_diagnosis
                ORDER BY count_vn DESC 
                LIMIT 50 ";


        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            $rawData2 = \yii::$app->db->createCommand($sql2)->queryAll();
            $rawData3 = \yii::$app->db->createCommand($sql3)->queryAll();
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

        $dataProvider3 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData3,
            'pagination' => FALSE,
        ]);

        return $this->render('report9', [
                    'dataProvider' => $dataProvider,
                    'dataProvider2' => $dataProvider2,
                    'dataProvider3' => $dataProvider3,
                    'rawData' => $rawData,
                    'rawData2' => $rawData2,
                    'rawData3' => $rawData3,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport10($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report10', $this->getSession());


        $report_name = "รายงานผู้รับบริการหัตถการ เย็บแผลทั่วไป,excission,off norplant,ฝัง norplant,stitch off (ตัดไหม)";

        $sql = "select er.vn,v.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
            concat(DAY(er.vstdate),'/',MONTH(er.vstdate),'/',(YEAR(er.vstdate)+543)) as vstdate,
                (
                    select count(oper.er_oper_code) from  er_regist_oper oper  where oper.vn = er.vn
                        and oper.er_oper_code in (355,643,62,63,552)
                ) as count_oper_code ,
                (
                    select ec.name
                       from  er_regist_oper opern
                       left outer join  er_oper_code ec on ec.er_oper_code = opern.er_oper_code
                       where opern.vn = er.vn
                       and opern.er_oper_code in (355,643,62,63,552)
                       limit 1
                ) as oper_name

                from er_regist er

                left outer join vn_stat v on v.vn = er.vn
                left outer join patient p on p.hn = v.hn

                where er.vstdate between $datestart and $dateend    and
                (
                       select count(oper.er_oper_code) from  er_regist_oper oper  where oper.vn = er.vn
                        and er_oper_code in (355,643,62,63,552)
                ) >= 1 ";

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('report10', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport11($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report11', $this->getSession());


        $report_name = "ตรวจแลป Hemoculture";

        $sql = "SELECT 
                    lh.hn,concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
                    concat(DAY(lh.order_date),'/',MONTH(lh.order_date),'/',(YEAR(lh.order_date)+543)) as order_date,
                    concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)) as report_date,
                lo.lab_order_result
                FROM lab_head lh

                left outer join lab_order   lo on lo.lab_order_number = lh.lab_order_number
                left outer join patient pt on pt.hn = lh.hn
                WHERE  
                    lh.order_date between $datestart and $dateend
                    and lo.lab_items_code = '3166' ";



        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('report11', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport12($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report12', $this->getSession());


        $report_name = "รายงาน RE-Visit ผู้ป่วยนอกทั้งหมด ภายใน 48 ชั่วโมง";

        $sql = "select
                v.hn,
                concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vstdate
                ,v.age_y,
                concat(p.pname,p.fname,'  ',p.lname) as pt_name ,
                v.pdx,v.dx0 ,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5,
                v.old_diagnosis, v.lastvisit_hour
                from vn_stat  v
                left outer join patient p on p.hn = v.hn
                left outer join spclty s on s.spclty = v.spclty
                left OUTER join thaiaddress t on t.addressid=v.aid
                left outer join sex se on se.code = p.sex

                where v.old_diagnosis = 'Y'
                and v.lastvisit_hour <= 48
                and v.vstdate between $datestart and $dateend
                and (v.pdx not like 'K%' and v.pdx not like'Z%' and v.pdx not like'U%' and v.pdx is not null and v.pdx<>' ')

                 /*and  v.vn  not in (select e.vn from er_regist e ) */
                 /*group by v.hn */

                order by v.hn,v.vstdate";



        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('report12', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport13($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report13', $this->getSession());


        $report_name = "รายงานคนไข้ diag head injury รับบริการที่งานอุบัติเหตุฉุกเฉิน";

        $sql = "SELECT
                    concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vstdate,
                    v.vn,v.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
                    v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5

                FROM vn_stat v

                LEFT OUTER JOIN patient p on p.hn  = v.hn
                    
                WHERE v.vstdate between $datestart and $dateend  and
                    v.vn in
                    (
                     select vn from er_regist
                    )

                    and

                    (
                            v.pdx in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or


                            v.dx0 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            ) or

                            v.dx1 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            v.dx2 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            v.dx3 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            v.dx4 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            v.dx5 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )
                        ) group by v.hn ";


        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('report13', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport14($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report14', $this->getSession());

        $report_name = "รายงานคนไข้ Admit diag head injury";

        $sql = "SELECT
                    concat(DAY(a.regdate),'/',MONTH(a.regdate),'/',(YEAR(a.regdate)+543)) as regdate,
                    concat(DAY(a.dchdate),'/',MONTH(a.dchdate),'/',(YEAR(a.dchdate)+543)) as dchdate,
                    a.an,a.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
                    a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5

                FROM an_stat a

                LEFT OUTER JOIN patient p on p.hn  = a.hn
                    
                WHERE a.dchdate between $datestart and $dateend  and



                    (
                            a.pdx in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or


                            a.dx0 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            ) or

                            a.dx1 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            a.dx2 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            a.dx3 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            a.dx4 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            a.dx5 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )
                        )


            group by a.hn ";


        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('report14', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport15($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report15', $this->getSession());

        $report_name = "รายงานคนไข้ผู้ป่วยนอกทั้งหมด diag head injury";

        $sql = "SELECT
                    concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vstdate,
                    v.vn,v.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
                    v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5

                FROM vn_stat v

                LEFT OUTER JOIN patient p on p.hn  = v.hn
                    
                WHERE v.vstdate between $datestart and $dateend  

                    and

                    (
                            v.pdx in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or


                            v.dx0 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            ) or

                            v.dx1 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            v.dx2 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            v.dx3 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            v.dx4 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            v.dx5 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )
                        ) group by v.hn ";


        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('report15', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport16($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report16', $this->getSession());

        $report_name = "รายงานคนไข้ผู้ป่วยนอกทั้งหมด diag head injury Re-visit ภายใน 48 ชั่วโมง ";

        $sql = "SELECT
                    concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vstdate,
                    v.vn,v.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
                    v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5

                FROM vn_stat v
                LEFT OUTER JOIN patient p on p.hn  = v.hn                 
                WHERE v.vstdate between $datestart and $dateend   and

                    (
                            v.pdx in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or


                            v.dx0 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            ) or

                            v.dx1 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            v.dx2 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            v.dx3 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            v.dx4 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )  or

                            v.dx5 in ('S000','S007','S008','S009','S010','S017','S018','S019','S0200','S0201','S020','s0210','s0211','s021','s0270','s0271','s027',
                                      's0280','s0281','s028','s0290','s0291','s029','s033','s035',
                                      's0600','s0601','s060','s0610','s0611','s061','s0620','s0621','s062','s0630','s0631','s063','s0640','s0641','s064',
                                      's0650','s0651','s065','s0660','s0661','s066','s0670','s0671','s067','s0680','s0681','s068','s0690','s0691','s069',
                                      's071','s078','s079','s080','s088','s089','s090','s091','s097','s098','s099'

                            )
                        )

                        and v.old_diagnosis = 'Y'
                        and v.lastvisit_hour <= 48 group by v.hn ";

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('report16', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport17($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report17', $this->getSession());

        $report_name = "รายงานจำนวนครั้ง CPR ที่ห้องอุบัติเหตุฉุกเฉิน";

        $sql = "SELECT
                    v.vn,v.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
                    concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vstdate_thai,
                    v.vstdate,v.pdx,v.age_y , o.icode,
                    o.qty
                FROM vn_stat v
                LEFT OUTER JOIN opitemrece o on o.vn = v.vn
                LEFT OUTER JOIN patient p on p.hn = v.hn
                WHERE 
                    v.vstdate BETWEEN $datestart AND $dateend  AND v.vn IN

                (
                      select vn from er_regist
                )

                AND o.icode = '3001210'
                GROUP BY o.vn
                ORDER BY o.hn,o.vstdate ";

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('report17', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport18($datestart, $dateend, $details) {

        // save log
        $this->SaveLog($this->dep_controller, 'report18', $this->getSession());

        $report_name = "รายงานจำนวนครั้งผู้รับบริการในกลุ่มผู้ป่วยกระดูกหัก (แบบ Close) ที่ห้องอุบัติเหตุฉุกเฉิน ";


        $sql = "SELECT

                    e.er_dch_type,dch.name as dch_type,count(distinct(e.vn)) as count_vn

                    FROM er_regist  e

                    LEFT OUTER JOIN vn_stat v ON v.vn = e.vn
                    LEFT OUTER JOIN er_dch_type dch ON dch.er_dch_type = e.er_dch_type

                    WHERE e.vstdate BETWEEN $datestart AND $dateend  AND
                     (

                            v.pdx in

                            ('s0200','s3230','s6230','s9220'
                            's0210','s3240','s6240','s9230'
                            's0220','s3250','s6250','s9240'
                            's0230','s3270','s6260','s9250'
                            's0240','s3280','s6270','s9270'
                            's0250','s4200','s6280','s9290'
                            's0260','s4210','s7200'  
                            's0270','s4220','s7210'  
                            's0280','s4230','s7220'  
                            's1200','s4240','s7230'  
                            's1210','s4270','s7240'  
                            's1220','s4280','s7270'  
                            's1270','s4290','s7280'  
                            's1280','s5200','s7290'  
                            's1290','s5210','s8200'  
                            's2200','s5220','s8210'  
                            's2210','s5230','s8220'  
                            's2220','s5240','s8230'  
                            's2230','s5250','s8240'  
                            's2240','s5260','s8250'  
                            's2250','s5270','s8260'  
                            's2280','s5280','s8270'  
                            's2290','s5290','s8280'  
                            's3200','s6200','s8290'  
                            's3210','s6210','s9200'  
                            's3220','s6220','s9210'  
                            )


                            OR

                            v.dx0 in

                              ('s0200','s3230','s6230','s9220'
                            's0210','s3240','s6240','s9230'
                            's0220','s3250','s6250','s9240'
                            's0230','s3270','s6260','s9250'
                            's0240','s3280','s6270','s9270'
                            's0250','s4200','s6280','s9290'
                            's0260','s4210','s7200'  
                            's0270','s4220','s7210'  
                            's0280','s4230','s7220'  
                            's1200','s4240','s7230'  
                            's1210','s4270','s7240'  
                            's1220','s4280','s7270'  
                            's1270','s4290','s7280'  
                            's1280','s5200','s7290'  
                            's1290','s5210','s8200'  
                            's2200','s5220','s8210'  
                            's2210','s5230','s8220'  
                            's2220','s5240','s8230'  
                            's2230','s5250','s8240'  
                            's2240','s5260','s8250'  
                            's2250','s5270','s8260'  
                            's2280','s5280','s8270'  
                            's2290','s5290','s8280'  
                            's3200','s6200','s8290'  
                            's3210','s6210','s9200'  
                            's3220','s6220','s9210'  
                            )


                            OR

                            v.dx1 in

                              ('s0200','s3230','s6230','s9220'
                            's0210','s3240','s6240','s9230'
                            's0220','s3250','s6250','s9240'
                            's0230','s3270','s6260','s9250'
                            's0240','s3280','s6270','s9270'
                            's0250','s4200','s6280','s9290'
                            's0260','s4210','s7200'  
                            's0270','s4220','s7210'  
                            's0280','s4230','s7220'  
                            's1200','s4240','s7230'  
                            's1210','s4270','s7240'  
                            's1220','s4280','s7270'  
                            's1270','s4290','s7280'  
                            's1280','s5200','s7290'  
                            's1290','s5210','s8200'  
                            's2200','s5220','s8210'  
                            's2210','s5230','s8220'  
                            's2220','s5240','s8230'  
                            's2230','s5250','s8240'  
                            's2240','s5260','s8250'  
                            's2250','s5270','s8260'  
                            's2280','s5280','s8270'  
                            's2290','s5290','s8280'  
                            's3200','s6200','s8290'  
                            's3210','s6210','s9200'  
                            's3220','s6220','s9210'  
                            )

                             OR

                            v.dx2 in

                              ('s0200','s3230','s6230','s9220'
                            's0210','s3240','s6240','s9230'
                            's0220','s3250','s6250','s9240'
                            's0230','s3270','s6260','s9250'
                            's0240','s3280','s6270','s9270'
                            's0250','s4200','s6280','s9290'
                            's0260','s4210','s7200'  
                            's0270','s4220','s7210'  
                            's0280','s4230','s7220'  
                            's1200','s4240','s7230'  
                            's1210','s4270','s7240'  
                            's1220','s4280','s7270'  
                            's1270','s4290','s7280'  
                            's1280','s5200','s7290'  
                            's1290','s5210','s8200'  
                            's2200','s5220','s8210'  
                            's2210','s5230','s8220'  
                            's2220','s5240','s8230'  
                            's2230','s5250','s8240'  
                            's2240','s5260','s8250'  
                            's2250','s5270','s8260'  
                            's2280','s5280','s8270'  
                            's2290','s5290','s8280'  
                            's3200','s6200','s8290'  
                            's3210','s6210','s9200'  
                            's3220','s6220','s9210'  
                            )
                            
                            OR

                            v.dx3 in

                              ('s0200','s3230','s6230','s9220'
                            's0210','s3240','s6240','s9230'
                            's0220','s3250','s6250','s9240'
                            's0230','s3270','s6260','s9250'
                            's0240','s3280','s6270','s9270'
                            's0250','s4200','s6280','s9290'
                            's0260','s4210','s7200'  
                            's0270','s4220','s7210'  
                            's0280','s4230','s7220'  
                            's1200','s4240','s7230'  
                            's1210','s4270','s7240'  
                            's1220','s4280','s7270'  
                            's1270','s4290','s7280'  
                            's1280','s5200','s7290'  
                            's1290','s5210','s8200'  
                            's2200','s5220','s8210'  
                            's2210','s5230','s8220'  
                            's2220','s5240','s8230'  
                            's2230','s5250','s8240'  
                            's2240','s5260','s8250'  
                            's2250','s5270','s8260'  
                            's2280','s5280','s8270'  
                            's2290','s5290','s8280'  
                            's3200','s6200','s8290'  
                            's3210','s6210','s9200'  
                            's3220','s6220','s9210'  
                            )


                            OR

                            v.dx4 in

                              ('s0200','s3230','s6230','s9220'
                            's0210','s3240','s6240','s9230'
                            's0220','s3250','s6250','s9240'
                            's0230','s3270','s6260','s9250'
                            's0240','s3280','s6270','s9270'
                            's0250','s4200','s6280','s9290'
                            's0260','s4210','s7200'  
                            's0270','s4220','s7210'  
                            's0280','s4230','s7220'  
                            's1200','s4240','s7230'  
                            's1210','s4270','s7240'  
                            's1220','s4280','s7270'  
                            's1270','s4290','s7280'  
                            's1280','s5200','s7290'  
                            's1290','s5210','s8200'  
                            's2200','s5220','s8210'  
                            's2210','s5230','s8220'  
                            's2220','s5240','s8230'  
                            's2230','s5250','s8240'  
                            's2240','s5260','s8250'  
                            's2250','s5270','s8260'  
                            's2280','s5280','s8270'  
                            's2290','s5290','s8280'  
                            's3200','s6200','s8290'  
                            's3210','s6210','s9200'  
                            's3220','s6220','s9210'  
                            )


                            OR

                            v.dx5 in

                              ('s0200','s3230','s6230','s9220'
                            's0210','s3240','s6240','s9230'
                            's0220','s3250','s6250','s9240'
                            's0230','s3270','s6260','s9250'
                            's0240','s3280','s6270','s9270'
                            's0250','s4200','s6280','s9290'
                            's0260','s4210','s7200'  
                            's0270','s4220','s7210'  
                            's0280','s4230','s7220'  
                            's1200','s4240','s7230'  
                            's1210','s4270','s7240'  
                            's1220','s4280','s7270'  
                            's1270','s4290','s7280'  
                            's1280','s5200','s7290'  
                            's1290','s5210','s8200'  
                            's2200','s5220','s8210'  
                            's2210','s5230','s8220'  
                            's2220','s5240','s8230'  
                            's2230','s5250','s8240'  
                            's2240','s5260','s8250'  
                            's2250','s5270','s8260'  
                            's2280','s5280','s8270'  
                            's2290','s5290','s8280'  
                            's3200','s6200','s8290'  
                            's3210','s6210','s9200'  
                            's3220','s6220','s9210'  
                            )

                    )

                    GROUP BY e.er_dch_type";


        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);


        return $this->render('report18', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
                    'datestart' => $datestart,
                    'dateend' => $dateend
        ]);
    }

    
    public function actionReport19($er_dch_type, $datestart, $dateend, $report_name) {
        // save log
        $this->SaveLog($this->dep_controller, 'report19', $this->getSession());

        $report_name = "รายงานจำนวนครั้งผู้รับบริการในกลุ่มผู้ป่วยกระดูกหัก (แบบ Close) ที่ห้องอุบัติเหตุฉุกเฉิน  ระหว่างวันที่ $datestart ถึง $dateend";

        $sql = "SELECT

                    v.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
                    v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5,e.*,
                    concat(DAY(e.vstdate),'/',MONTH(e.vstdate),'/',(YEAR(e.vstdate)+543)) as vstdate_thai,
                    ro.refer_hospcode,
                    concat(hp.hosptype,hp.name) as hosp_name

                    FROM er_regist  e

                    LEFT OUTER JOIN vn_stat v ON v.vn = e.vn
                    LEFT OUTER JOIN patient p ON p.hn = v.hn
                    LEFT OUTER JOIN referout ro ON ro.vn = e.vn
                    LEFT OUTER JOIN hospcode hp ON hp.hospcode = ro.refer_hospcode

                    WHERE e.vstdate BETWEEN $datestart AND $dateend  AND
                     (

                        v.pdx in

                        ('s0200','s3230','s6230','s9220'
                        's0210','s3240','s6240','s9230'
                        's0220','s3250','s6250','s9240'
                        's0230','s3270','s6260','s9250'
                        's0240','s3280','s6270','s9270'
                        's0250','s4200','s6280','s9290'
                        's0260','s4210','s7200'  
                        's0270','s4220','s7210'  
                        's0280','s4230','s7220'  
                        's1200','s4240','s7230'  
                        's1210','s4270','s7240'  
                        's1220','s4280','s7270'  
                        's1270','s4290','s7280'  
                        's1280','s5200','s7290'  
                        's1290','s5210','s8200'  
                        's2200','s5220','s8210'  
                        's2210','s5230','s8220'  
                        's2220','s5240','s8230'  
                        's2230','s5250','s8240'  
                        's2240','s5260','s8250'  
                        's2250','s5270','s8260'  
                        's2280','s5280','s8270'  
                        's2290','s5290','s8280'  
                        's3200','s6200','s8290'  
                        's3210','s6210','s9200'  
                        's3220','s6220','s9210'  
                        )


                        OR

                        v.dx0 in

                          ('s0200','s3230','s6230','s9220'
                        's0210','s3240','s6240','s9230'
                        's0220','s3250','s6250','s9240'
                        's0230','s3270','s6260','s9250'
                        's0240','s3280','s6270','s9270'
                        's0250','s4200','s6280','s9290'
                        's0260','s4210','s7200'  
                        's0270','s4220','s7210'  
                        's0280','s4230','s7220'  
                        's1200','s4240','s7230'  
                        's1210','s4270','s7240'  
                        's1220','s4280','s7270'  
                        's1270','s4290','s7280'  
                        's1280','s5200','s7290'  
                        's1290','s5210','s8200'  
                        's2200','s5220','s8210'  
                        's2210','s5230','s8220'  
                        's2220','s5240','s8230'  
                        's2230','s5250','s8240'  
                        's2240','s5260','s8250'  
                        's2250','s5270','s8260'  
                        's2280','s5280','s8270'  
                        's2290','s5290','s8280'  
                        's3200','s6200','s8290'  
                        's3210','s6210','s9200'  
                        's3220','s6220','s9210'  
                        )


                        OR

                        v.dx1 in

                          ('s0200','s3230','s6230','s9220'
                        's0210','s3240','s6240','s9230'
                        's0220','s3250','s6250','s9240'
                        's0230','s3270','s6260','s9250'
                        's0240','s3280','s6270','s9270'
                        's0250','s4200','s6280','s9290'
                        's0260','s4210','s7200'  
                        's0270','s4220','s7210'  
                        's0280','s4230','s7220'  
                        's1200','s4240','s7230'  
                        's1210','s4270','s7240'  
                        's1220','s4280','s7270'  
                        's1270','s4290','s7280'  
                        's1280','s5200','s7290'  
                        's1290','s5210','s8200'  
                        's2200','s5220','s8210'  
                        's2210','s5230','s8220'  
                        's2220','s5240','s8230'  
                        's2230','s5250','s8240'  
                        's2240','s5260','s8250'  
                        's2250','s5270','s8260'  
                        's2280','s5280','s8270'  
                        's2290','s5290','s8280'  
                        's3200','s6200','s8290'  
                        's3210','s6210','s9200'  
                        's3220','s6220','s9210'  
                        )

                         OR

                        v.dx2 in

                          ('s0200','s3230','s6230','s9220'
                        's0210','s3240','s6240','s9230'
                        's0220','s3250','s6250','s9240'
                        's0230','s3270','s6260','s9250'
                        's0240','s3280','s6270','s9270'
                        's0250','s4200','s6280','s9290'
                        's0260','s4210','s7200'  
                        's0270','s4220','s7210'  
                        's0280','s4230','s7220'  
                        's1200','s4240','s7230'  
                        's1210','s4270','s7240'  
                        's1220','s4280','s7270'  
                        's1270','s4290','s7280'  
                        's1280','s5200','s7290'  
                        's1290','s5210','s8200'  
                        's2200','s5220','s8210'  
                        's2210','s5230','s8220'  
                        's2220','s5240','s8230'  
                        's2230','s5250','s8240'  
                        's2240','s5260','s8250'  
                        's2250','s5270','s8260'  
                        's2280','s5280','s8270'  
                        's2290','s5290','s8280'  
                        's3200','s6200','s8290'  
                        's3210','s6210','s9200'  
                        's3220','s6220','s9210'  
                        )
                        
                        OR

                        v.dx3 in

                          ('s0200','s3230','s6230','s9220'
                        's0210','s3240','s6240','s9230'
                        's0220','s3250','s6250','s9240'
                        's0230','s3270','s6260','s9250'
                        's0240','s3280','s6270','s9270'
                        's0250','s4200','s6280','s9290'
                        's0260','s4210','s7200'  
                        's0270','s4220','s7210'  
                        's0280','s4230','s7220'  
                        's1200','s4240','s7230'  
                        's1210','s4270','s7240'  
                        's1220','s4280','s7270'  
                        's1270','s4290','s7280'  
                        's1280','s5200','s7290'  
                        's1290','s5210','s8200'  
                        's2200','s5220','s8210'  
                        's2210','s5230','s8220'  
                        's2220','s5240','s8230'  
                        's2230','s5250','s8240'  
                        's2240','s5260','s8250'  
                        's2250','s5270','s8260'  
                        's2280','s5280','s8270'  
                        's2290','s5290','s8280'  
                        's3200','s6200','s8290'  
                        's3210','s6210','s9200'  
                        's3220','s6220','s9210'  
                        )


                        OR

                        v.dx4 in

                          ('s0200','s3230','s6230','s9220'
                        's0210','s3240','s6240','s9230'
                        's0220','s3250','s6250','s9240'
                        's0230','s3270','s6260','s9250'
                        's0240','s3280','s6270','s9270'
                        's0250','s4200','s6280','s9290'
                        's0260','s4210','s7200'  
                        's0270','s4220','s7210'  
                        's0280','s4230','s7220'  
                        's1200','s4240','s7230'  
                        's1210','s4270','s7240'  
                        's1220','s4280','s7270'  
                        's1270','s4290','s7280'  
                        's1280','s5200','s7290'  
                        's1290','s5210','s8200'  
                        's2200','s5220','s8210'  
                        's2210','s5230','s8220'  
                        's2220','s5240','s8230'  
                        's2230','s5250','s8240'  
                        's2240','s5260','s8250'  
                        's2250','s5270','s8260'  
                        's2280','s5280','s8270'  
                        's2290','s5290','s8280'  
                        's3200','s6200','s8290'  
                        's3210','s6210','s9200'  
                        's3220','s6220','s9210'  
                        )


                        OR

                        v.dx5 in

                          ('s0200','s3230','s6230','s9220'
                        's0210','s3240','s6240','s9230'
                        's0220','s3250','s6250','s9240'
                        's0230','s3270','s6260','s9250'
                        's0240','s3280','s6270','s9270'
                        's0250','s4200','s6280','s9290'
                        's0260','s4210','s7200'  
                        's0270','s4220','s7210'  
                        's0280','s4230','s7220'  
                        's1200','s4240','s7230'  
                        's1210','s4270','s7240'  
                        's1220','s4280','s7270'  
                        's1270','s4290','s7280'  
                        's1280','s5200','s7290'  
                        's1290','s5210','s8200'  
                        's2200','s5220','s8210'  
                        's2210','s5230','s8220'  
                        's2220','s5240','s8230'  
                        's2230','s5250','s8240'  
                        's2240','s5260','s8250'  
                        's2250','s5270','s8260'  
                        's2280','s5280','s8270'  
                        's2290','s5290','s8280'  
                        's3200','s6200','s8290'  
                        's3210','s6210','s9200'  
                        's3220','s6220','s9210'  
                        )

                    ) AND e.er_dch_type = $er_dch_type ";



        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }


        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);


        return $this->render('report19', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'er_dch_type' => $er_dch_type,
        ]);
    }
    
    
    
    
    
    
    
    public function actionReport20($datestart, $dateend, $details) {

        // save log
        $this->SaveLog($this->dep_controller, 'report20', $this->getSession());

        $report_name = "รายงานจำนวนครั้งผู้รับบริการในกลุ่มผู้ป่วยกระดูกหัก (แบบ Open) ที่ห้องอุบัติเหตุฉุกเฉิน ";

        $sql = "SELECT

                    e.er_dch_type,dch.name as dch_type,count(distinct(e.vn)) as count_vn

                    FROM er_regist  e

                    LEFT OUTER JOIN vn_stat v ON v.vn = e.vn
                    LEFT OUTER JOIN er_dch_type dch ON dch.er_dch_type = e.er_dch_type

                    WHERE e.vstdate BETWEEN $datestart AND $dateend  AND
                     (

                            v.pdx in

                            ('s0201','s3231','s6231','s9221'
                                's0211','s3241','s6241','s9231'
                                's0221','s3251','s6251','s9241'
                                's0231','s3271','s6261','s9251'
                                's0241','s3281','s6271','s9271'
                                's0251','s4201','s6281','s9291'
                                's0261','s4211','s7201'	
                                's0271','s4221','s7211'	
                                's0281','s4231','s7221'	
                                's1201','s4241','s7231'	
                                's1211','s4271','s7241'	
                                's1221','s4281','s7271'	
                                's1271','s4291','s7281'	
                                's1281','s5201','s7291'	
                                's1291','s5211','s8201'	
                                's2201','s5221','s8211'	
                                's2211','s5231','s8221'	
                                's2221','s5241','s8231'	
                                's2231','s5251','s8241'	
                                's2241','s5261','s8251'	
                                's2251','s5271','s8261'	
                                's2281','s5281','s8271'	
                                's2291','s5291','s8281'	
                                's3201','s6201','s8291'	
                                's3211','s6211','s9201'	
                                's3221','s6221','s9211' )	
                           
                            OR

                            v.dx0 in

                              ('s0201','s3231','s6231','s9221'
                                's0211','s3241','s6241','s9231'
                                's0221','s3251','s6251','s9241'
                                's0231','s3271','s6261','s9251'
                                's0241','s3281','s6271','s9271'
                                's0251','s4201','s6281','s9291'
                                's0261','s4211','s7201'	
                                's0271','s4221','s7211'	
                                's0281','s4231','s7221'	
                                's1201','s4241','s7231'	
                                's1211','s4271','s7241'	
                                's1221','s4281','s7271'	
                                's1271','s4291','s7281'	
                                's1281','s5201','s7291'	
                                's1291','s5211','s8201'	
                                's2201','s5221','s8211'	
                                's2211','s5231','s8221'	
                                's2221','s5241','s8231'	
                                's2231','s5251','s8241'	
                                's2241','s5261','s8251'	
                                's2251','s5271','s8261'	
                                's2281','s5281','s8271'	
                                's2291','s5291','s8281'	
                                's3201','s6201','s8291'	
                                's3211','s6211','s9201'	
                                's3221','s6221','s9211'	 )
                        

                            OR

                            v.dx1 in

                              ('s0201','s3231','s6231','s9221'
                                's0211','s3241','s6241','s9231'
                                's0221','s3251','s6251','s9241'
                                's0231','s3271','s6261','s9251'
                                's0241','s3281','s6271','s9271'
                                's0251','s4201','s6281','s9291'
                                's0261','s4211','s7201'	
                                's0271','s4221','s7211'	
                                's0281','s4231','s7221'	
                                's1201','s4241','s7231'	
                                's1211','s4271','s7241'	
                                's1221','s4281','s7271'	
                                's1271','s4291','s7281'	
                                's1281','s5201','s7291'	
                                's1291','s5211','s8201'	
                                's2201','s5221','s8211'	
                                's2211','s5231','s8221'	
                                's2221','s5241','s8231'	
                                's2231','s5251','s8241'	
                                's2241','s5261','s8251'	
                                's2251','s5271','s8261'	
                                's2281','s5281','s8271'	
                                's2291','s5291','s8281'	
                                's3201','s6201','s8291'	
                                's3211','s6211','s9201'	
                                's3221','s6221','s9211'	)
                         
                             OR

                            v.dx2 in

                              ('s0201','s3231','s6231','s9221'
                                's0211','s3241','s6241','s9231'
                                's0221','s3251','s6251','s9241'
                                's0231','s3271','s6261','s9251'
                                's0241','s3281','s6271','s9271'
                                's0251','s4201','s6281','s9291'
                                's0261','s4211','s7201'	
                                's0271','s4221','s7211'	
                                's0281','s4231','s7221'	
                                's1201','s4241','s7231'	
                                's1211','s4271','s7241'	
                                's1221','s4281','s7271'	
                                's1271','s4291','s7281'	
                                's1281','s5201','s7291'	
                                's1291','s5211','s8201'	
                                's2201','s5221','s8211'	
                                's2211','s5231','s8221'	
                                's2221','s5241','s8231'	
                                's2231','s5251','s8241'	
                                's2241','s5261','s8251'	
                                's2251','s5271','s8261'	
                                's2281','s5281','s8271'	
                                's2291','s5291','s8281'	
                                's3201','s6201','s8291'	
                                's3211','s6211','s9201'	
                                's3221','s6221','s9211'	 )
                          
                            
                            OR

                            v.dx3 in

                              ('s0201','s3231','s6231','s9221'
                                's0211','s3241','s6241','s9231'
                                's0221','s3251','s6251','s9241'
                                's0231','s3271','s6261','s9251'
                                's0241','s3281','s6271','s9271'
                                's0251','s4201','s6281','s9291'
                                's0261','s4211','s7201'	
                                's0271','s4221','s7211'	
                                's0281','s4231','s7221'	
                                's1201','s4241','s7231'	
                                's1211','s4271','s7241'	
                                's1221','s4281','s7271'	
                                's1271','s4291','s7281'	
                                's1281','s5201','s7291'	
                                's1291','s5211','s8201'	
                                's2201','s5221','s8211'	
                                's2211','s5231','s8221'	
                                's2221','s5241','s8231'	
                                's2231','s5251','s8241'	
                                's2241','s5261','s8251'	
                                's2251','s5271','s8261'	
                                's2281','s5281','s8271'	
                                's2291','s5291','s8281'	
                                's3201','s6201','s8291'	
                                's3211','s6211','s9201'	
                                's3221','s6221','s9211'	 )
                           

                            OR

                            v.dx4 in

                              ('s0201','s3231','s6231','s9221'
                                's0211','s3241','s6241','s9231'
                                's0221','s3251','s6251','s9241'
                                's0231','s3271','s6261','s9251'
                                's0241','s3281','s6271','s9271'
                                's0251','s4201','s6281','s9291'
                                's0261','s4211','s7201'	
                                's0271','s4221','s7211'	
                                's0281','s4231','s7221'	
                                's1201','s4241','s7231'	
                                's1211','s4271','s7241'	
                                's1221','s4281','s7271'	
                                's1271','s4291','s7281'	
                                's1281','s5201','s7291'	
                                's1291','s5211','s8201'	
                                's2201','s5221','s8211'	
                                's2211','s5231','s8221'	
                                's2221','s5241','s8231'	
                                's2231','s5251','s8241'	
                                's2241','s5261','s8251'	
                                's2251','s5271','s8261'	
                                's2281','s5281','s8271'	
                                's2291','s5291','s8281'	
                                's3201','s6201','s8291'	
                                's3211','s6211','s9201'	
                                's3221','s6221','s9211'	)
                          

                            OR

                            v.dx5 in

                              ('s0201','s3231','s6231','s9221'
                                's0211','s3241','s6241','s9231'
                                's0221','s3251','s6251','s9241'
                                's0231','s3271','s6261','s9251'
                                's0241','s3281','s6271','s9271'
                                's0251','s4201','s6281','s9291'
                                's0261','s4211','s7201'	
                                's0271','s4221','s7211'	
                                's0281','s4231','s7221'	
                                's1201','s4241','s7231'	
                                's1211','s4271','s7241'	
                                's1221','s4281','s7271'	
                                's1271','s4291','s7281'	
                                's1281','s5201','s7291'	
                                's1291','s5211','s8201'	
                                's2201','s5221','s8211'	
                                's2211','s5231','s8221'	
                                's2221','s5241','s8231'	
                                's2231','s5251','s8241'	
                                's2241','s5261','s8251'	
                                's2251','s5271','s8261'	
                                's2281','s5281','s8271'	
                                's2291','s5291','s8281'	
                                's3201','s6201','s8291'	
                                's3211','s6211','s9201'	
                                's3221','s6221','s9211'	)                        

                    )

                    GROUP BY e.er_dch_type";


        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);


        return $this->render('report20', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
                    'datestart' => $datestart,
                    'dateend' => $dateend
        ]);
    }

    
    
     public function actionReport21($er_dch_type, $datestart, $dateend, $report_name) {
        // save log
        $this->SaveLog($this->dep_controller, 'report21', $this->getSession());

        $report_name = "รายงานจำนวนครั้งผู้รับบริการในกลุ่มผู้ป่วยกระดูกหัก (แบบ Open) ที่ห้องอุบัติเหตุฉุกเฉิน  ระหว่างวันที่ $datestart ถึง $dateend";

        $sql = "SELECT
                    v.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
                    v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5,e.*,
                    concat(DAY(e.vstdate),'/',MONTH(e.vstdate),'/',(YEAR(e.vstdate)+543)) as vstdate_thai,
                    ro.refer_hospcode,
                    concat(hp.hosptype,hp.name) as hosp_name

                    FROM er_regist  e

                    LEFT OUTER JOIN vn_stat v ON v.vn = e.vn
                    LEFT OUTER JOIN patient p ON p.hn = v.hn
                    LEFT OUTER JOIN referout ro ON ro.vn = e.vn
                    LEFT OUTER JOIN hospcode hp ON hp.hospcode = ro.refer_hospcode

                    WHERE e.vstdate BETWEEN $datestart AND $dateend  AND
                     (

                        v.pdx in

                        ('s0201','s3231','s6231','s9221'
                            's0211','s3241','s6241','s9231'
                            's0221','s3251','s6251','s9241'
                            's0231','s3271','s6261','s9251'
                            's0241','s3281','s6271','s9271'
                            's0251','s4201','s6281','s9291'
                            's0261','s4211','s7201'	
                            's0271','s4221','s7211'	
                            's0281','s4231','s7221'	
                            's1201','s4241','s7231'	
                            's1211','s4271','s7241'	
                            's1221','s4281','s7271'	
                            's1271','s4291','s7281'	
                            's1281','s5201','s7291'	
                            's1291','s5211','s8201'	
                            's2201','s5221','s8211'	
                            's2211','s5231','s8221'	
                            's2221','s5241','s8231'	
                            's2231','s5251','s8241'	
                            's2241','s5261','s8251'	
                            's2251','s5271','s8261'	
                            's2281','s5281','s8271'	
                            's2291','s5291','s8281'	
                            's3201','s6201','s8291'	
                            's3211','s6211','s9201'	
                            's3221','s6221','s9211' )
                        
                        OR

                        v.dx0 in

                          ('s0201','s3231','s6231','s9221'
                            's0211','s3241','s6241','s9231'
                            's0221','s3251','s6251','s9241'
                            's0231','s3271','s6261','s9251'
                            's0241','s3281','s6271','s9271'
                            's0251','s4201','s6281','s9291'
                            's0261','s4211','s7201'	
                            's0271','s4221','s7211'	
                            's0281','s4231','s7221'	
                            's1201','s4241','s7231'	
                            's1211','s4271','s7241'	
                            's1221','s4281','s7271'	
                            's1271','s4291','s7281'	
                            's1281','s5201','s7291'	
                            's1291','s5211','s8201'	
                            's2201','s5221','s8211'	
                            's2211','s5231','s8221'	
                            's2221','s5241','s8231'	
                            's2231','s5251','s8241'	
                            's2241','s5261','s8251'	
                            's2251','s5271','s8261'	
                            's2281','s5281','s8271'	
                            's2291','s5291','s8281'	
                            's3201','s6201','s8291'	
                            's3211','s6211','s9201'	
                            's3221','s6221','s9211' )	
                      
                        OR

                        v.dx1 in

                          ('s0201','s3231','s6231','s9221'
                            's0211','s3241','s6241','s9231'
                            's0221','s3251','s6251','s9241'
                            's0231','s3271','s6261','s9251'
                            's0241','s3281','s6271','s9271'
                            's0251','s4201','s6281','s9291'
                            's0261','s4211','s7201'	
                            's0271','s4221','s7211'	
                            's0281','s4231','s7221'	
                            's1201','s4241','s7231'	
                            's1211','s4271','s7241'	
                            's1221','s4281','s7271'	
                            's1271','s4291','s7281'	
                            's1281','s5201','s7291'	
                            's1291','s5211','s8201'	
                            's2201','s5221','s8211'	
                            's2211','s5231','s8221'	
                            's2221','s5241','s8231'	
                            's2231','s5251','s8241'	
                            's2241','s5261','s8251'	
                            's2251','s5271','s8261'	
                            's2281','s5281','s8271'	
                            's2291','s5291','s8281'	
                            's3201','s6201','s8291'	
                            's3211','s6211','s9201'	
                            's3221','s6221','s9211' )	
                    
                         OR

                        v.dx2 in

                          ('s0201','s3231','s6231','s9221'
                            's0211','s3241','s6241','s9231'
                            's0221','s3251','s6251','s9241'
                            's0231','s3271','s6261','s9251'
                            's0241','s3281','s6271','s9271'
                            's0251','s4201','s6281','s9291'
                            's0261','s4211','s7201'	
                            's0271','s4221','s7211'	
                            's0281','s4231','s7221'	
                            's1201','s4241','s7231'	
                            's1211','s4271','s7241'	
                            's1221','s4281','s7271'	
                            's1271','s4291','s7281'	
                            's1281','s5201','s7291'	
                            's1291','s5211','s8201'	
                            's2201','s5221','s8211'	
                            's2211','s5231','s8221'	
                            's2221','s5241','s8231'	
                            's2231','s5251','s8241'	
                            's2241','s5261','s8251'	
                            's2251','s5271','s8261'	
                            's2281','s5281','s8271'	
                            's2291','s5291','s8281'	
                            's3201','s6201','s8291'	
                            's3211','s6211','s9201'	
                            's3221','s6221','s9211')	                      
                        
                        OR

                        v.dx3 in

                          ('s0201','s3231','s6231','s9221'
                            's0211','s3241','s6241','s9231'
                            's0221','s3251','s6251','s9241'
                            's0231','s3271','s6261','s9251'
                            's0241','s3281','s6271','s9271'
                            's0251','s4201','s6281','s9291'
                            's0261','s4211','s7201'	
                            's0271','s4221','s7211'	
                            's0281','s4231','s7221'	
                            's1201','s4241','s7231'	
                            's1211','s4271','s7241'	
                            's1221','s4281','s7271'	
                            's1271','s4291','s7281'	
                            's1281','s5201','s7291'	
                            's1291','s5211','s8201'	
                            's2201','s5221','s8211'	
                            's2211','s5231','s8221'	
                            's2221','s5241','s8231'	
                            's2231','s5251','s8241'	
                            's2241','s5261','s8251'	
                            's2251','s5271','s8261'	
                            's2281','s5281','s8271'	
                            's2291','s5291','s8281'	
                            's3201','s6201','s8291'	
                            's3211','s6211','s9201'	
                            's3221','s6221','s9211' )	
                      
                        OR

                        v.dx4 in

                          ('s0201','s3231','s6231','s9221'
                            's0211','s3241','s6241','s9231'
                            's0221','s3251','s6251','s9241'
                            's0231','s3271','s6261','s9251'
                            's0241','s3281','s6271','s9271'
                            's0251','s4201','s6281','s9291'
                            's0261','s4211','s7201'	
                            's0271','s4221','s7211'	
                            's0281','s4231','s7221'	
                            's1201','s4241','s7231'	
                            's1211','s4271','s7241'	
                            's1221','s4281','s7271'	
                            's1271','s4291','s7281'	
                            's1281','s5201','s7291'	
                            's1291','s5211','s8201'	
                            's2201','s5221','s8211'	
                            's2211','s5231','s8221'	
                            's2221','s5241','s8231'	
                            's2231','s5251','s8241'	
                            's2241','s5261','s8251'	
                            's2251','s5271','s8261'	
                            's2281','s5281','s8271'	
                            's2291','s5291','s8281'	
                            's3201','s6201','s8291'	
                            's3211','s6211','s9201'	
                            's3221','s6221','s9211' )	
                        
                        OR

                        v.dx5 in

                          ('s0201','s3231','s6231','s9221'
                            's0211','s3241','s6241','s9231'
                            's0221','s3251','s6251','s9241'
                            's0231','s3271','s6261','s9251'
                            's0241','s3281','s6271','s9271'
                            's0251','s4201','s6281','s9291'
                            's0261','s4211','s7201'	
                            's0271','s4221','s7211'	
                            's0281','s4231','s7221'	
                            's1201','s4241','s7231'	
                            's1211','s4271','s7241'	
                            's1221','s4281','s7271'	
                            's1271','s4291','s7281'	
                            's1281','s5201','s7291'	
                            's1291','s5211','s8201'	
                            's2201','s5221','s8211'	
                            's2211','s5231','s8221'	
                            's2221','s5241','s8231'	
                            's2231','s5251','s8241'	
                            's2241','s5261','s8251'	
                            's2251','s5271','s8261'	
                            's2281','s5281','s8271'	
                            's2291','s5291','s8281'	
                            's3201','s6201','s8291'	
                            's3211','s6211','s9201'	
                            's3221','s6221','s9211' )	
                       
                    ) AND e.er_dch_type = $er_dch_type ";



        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }


        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);


        return $this->render('report21', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'er_dch_type' => $er_dch_type,
        ]);
    }
    
    

}

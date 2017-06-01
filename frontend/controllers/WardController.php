<?php

namespace frontend\controllers;
use Yii;
use frontend\components\CommonController;

class WardController extends CommonController {
    public $dep_controller = 'ward';

    public function actionReport1($datestart, $dateend, $details) {
             // save log
        $this->SaveLog($this->dep_controller, 'report1', $this->getSession());
              
        $count_day = (strtotime($dateend) - strtotime($datestart)) / ( 60 * 60 * 24 ) +1;
  
        $report_name = " รายงานผู้ป่วยใน รง.505";
        $sql = "SELECT 'รายงานอัตราการครองเตียง(Bed Occupancy Rate)' as name,sum(admdate) * 100/(30*$count_day) as result FROM an_stat   WHERE  dchdate BETWEEN $datestart AND $dateend 
               union
                SELECT 'อัตราการใช้เตียง (Bed Turnover Rate)' as name,count(distinct(an)) / 30 as result FROM an_stat   WHERE  dchdate BETWEEN $datestart AND $dateend
               union
                SELECT 'วันนอนเฉลี่ยผู้ป่วยใน(Length of Stay)' as name,sum(admdate) / count(distinct(an)) as result FROM an_stat   WHERE  dchdate BETWEEN $datestart AND $dateend
               union
               select 'อัตราผู้ป่วยในต่อผู้ป่วยนอก' as name,count(distinct(an)) /
                        (
                            select count(distinct(vn)) from vn_stat where vstdate between $datestart AND $dateend
                        )
                as result FROM an_stat   WHERE  dchdate BETWEEN $datestart AND $dateend
               union
               
                select 'วันนอนเฉลี่ยแยกรายสิทธิ UC' as name,sum(admdate) / count(distinct(an)) as result
                 FROM an_stat   WHERE  dchdate BETWEEN $datestart AND $dateend  AND
                pttype in (89,56,57,52,54)
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

        return $this->render('report1', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]); 
    }
    
    
     public function actionReport2($datestart, $dateend, $details) {
              // save log
        $this->SaveLog($this->dep_controller, 'report2', $this->getSession());
        
       
        $report_name = "คนไข้ IPD RE-ADMIT ภายใน 28 วัน ด้วยโรคเดิม";
        $sql = "select q3.hn,concat(patient.pname,patient.fname,'  ',patient.lname) as ptname,q3.AN_new ,q3.regdate_AN_New ,q3.dcdate_AN_New ,q3.AN_Old as AN_old
 ,q3.regdate_AN_Old ,q3.dcdate_AN_Old ,q3.icd10_1,q3.ReAdmitDate

 from patient inner join 
 (select q1.hn ,q1.an as AN_new ,q1.regdate as regdate_AN_New,q1.dchdate as dcdate_AN_New,q2.an as AN_old ,q2.regdate as regdate_AN_Old 
 ,q2.dchdate as dcdate_AN_Old,q1.icd10 as icd10_1,TIMESTAMPDIFF(day,substring(q2.dchdate,1,10),substring(q1.regdate,1,10)) as ReAdmitDate

from (select ipt.hn ,ipt.an ,ipt.regdate,ipt.dchdate,iptdiag.icd10 ,iptdiag.diagtype from 

 ipt  inner join iptdiag on ipt.an = iptdiag.an where ipt.hn != ' ' and iptdiag.diagtype = '1') as q1

 inner join 

(select ipt1.hn ,ipt1.an ,ipt1.regdate,ipt1.dchdate,iptdiag1.icd10 ,iptdiag1.diagtype from ipt as ipt1 
inner join iptdiag as iptdiag1 on ipt1.an = iptdiag1.an where ipt1.hn != ' ' and iptdiag1.diagtype ='1' ) as q2
 where q1.hn = q2.hn and q1.an <> q2.an and q1.icd10 = q2.icd10 and 
TIMESTAMPDIFF(day,substring(q2.dchdate,1,10),substring(q1.regdate,1,10)) > 0 and 
TIMESTAMPDIFF(day,substring(q2.dchdate,1,10),substring(q1.regdate,1,10)) <= 28 and 

q1.regdate between $datestart AND $dateend ) as q3  on q3.hn = patient.hn ";

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
        
       
        $report_name = "รายงานอันดับโรคคนไข้ IPD RE-ADMIT ภายใน 28 วัน ด้วยโรคเดิม";
        $sql = "select q3.icd10_1,icd.name as icd_name,count(q3.icd10_1)   as count_icd

            from patient inner join 
            (select q1.hn ,q1.an as AN_new ,q1.regdate as regdate_AN_New,q1.dchdate as dcdate_AN_New,q2.an as AN_old ,q2.regdate as regdate_AN_Old
            ,q2.dchdate as dcdate_AN_Old,q1.icd10 as icd10_1,TIMESTAMPDIFF(day,substring(q2.dchdate,1,10),substring(q1.regdate,1,10)) as ReAdmitDate

           from (select ipt.hn ,ipt.an ,ipt.regdate,ipt.dchdate,iptdiag.icd10 ,iptdiag.diagtype from 

            ipt  inner join iptdiag on ipt.an = iptdiag.an where ipt.hn != ' ' and iptdiag.diagtype = '1') as q1

            inner join 

           (select ipt1.hn ,ipt1.an ,ipt1.regdate,ipt1.dchdate,iptdiag1.icd10 ,iptdiag1.diagtype from ipt as ipt1 
           inner join iptdiag as iptdiag1 on ipt1.an = iptdiag1.an where ipt1.hn != ' ' and iptdiag1.diagtype ='1' ) as q2
            where q1.hn = q2.hn and q1.an <> q2.an and q1.icd10 = q2.icd10 and 
           TIMESTAMPDIFF(day,substring(q2.dchdate,1,10),substring(q1.regdate,1,10)) > 0 and 
           TIMESTAMPDIFF(day,substring(q2.dchdate,1,10),substring(q1.regdate,1,10)) <= 28 and 

           q1.regdate between $datestart AND $dateend ) as q3  on q3.hn = patient.hn

           left outer join icd101 icd on icd.code = q3.icd10_1

           group by q3.icd10_1
           order by count_icd desc ";

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
    
    
     public function actionReport4($refer_type_id,$datestart, $dateend, $details) {
         
              // save log
        $this->SaveLog($this->dep_controller, 'report4', $this->getSession());
        
       
        $report_name = "รายงานสรุปอันดับโรคส่ง Refer ที่ผู้ป่วยใน(Ward)"; 
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
                    d.name as doctor_name,ro.pdx as pdx,
                    if(ro.confirm_text!='',ro.confirm_text,'-') as confirm_text,
                    ro.refer_hospcode, concat(hp.hosptype,' ',hp.name) as refer_hospname,
                    rp.refer_response_type_name,rt.refer_type_name,ro.department,ro.vn,
                    ro.refer_number,ro.rfrcs,ro.refer_response_type_id,ro.hn,
                    rfp.name as refer_point_name,
                    if(ro.pre_diagnosis!='',ro.pre_diagnosis,'-') as pre_diagnosis,
                    d.name as doctor_name,
                    ro.refer_number,ks.department as department_name,ro.other_text,
                    concat(DAY(ro.refer_date),'/',MONTH(ro.refer_date),'/',(YEAR(ro.refer_date)+543)) as refer_date,
                    o.regdate as vstdate,ro.refer_time,o.regtime as vsttime,
                    concat(p.pname,p.fname,'  ',p.lname) as ptname,
                    concat(h.hosptype,' ',h.name) as hospname,pe.name as pttype_name,  r.name as refername,
                    ro.refer_point,ro.pdx as icd,ic.name as icd_name,
                    o.regdate as vstdate

                FROM referout ro

                    left outer join ipt o on o.an = ro.vn
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
                    ro.department = 'IPD' 
                    and ro.refer_date between $datestart AND $dateend  
                        $refer
                    and ro.depcode='003' ";
        
        
        $sql2 = "SELECT
                    ro.pdx,count(distinct(ro.vn)) as count_vn
                FROM referout ro
                    left outer join ipt o on o.an = ro.vn
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
                    ro.department = 'IPD' 
                    and ro.pdx != ''
                    and ro.refer_date between $datestart AND $dateend  
                        $refer
                    and ro.depcode='003'
                    GROUP BY ro.pdx
                    ORDER BY count_vn DESC 
                    LIMIT 30 ";
        
        
        /* สรุปตามการวินิจฉัยโรคขั้นต้น */
         $sql3 = "SELECT
                    ro.pre_diagnosis,count(distinct(ro.vn)) as count_vn
                FROM referout ro
                    left outer join ipt o on o.an = ro.vn
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
                    ro.department = 'IPD' 
                    and ro.refer_date between $datestart AND $dateend  
                        $refer
                    and ro.depcode='003'
                    and ro.pre_diagnosis != ''
                    GROUP BY ro.pre_diagnosis
                    ORDER BY count_vn DESC 
                    LIMIT 30 ";
         
        
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

        return $this->render('report4', [
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
    
    
    
     public function actionReport5($datestart, $dateend, $details) {
         
              // save log
        $this->SaveLog($this->dep_controller, 'report5', $this->getSession());
        
       
        $report_name = "รายงานผู้ป่วย admit ความดันโลหิตสูง";
        $sql = "SELECT 
                    ov.hn,concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
                    a.an,
                    concat(DAY(a.regdate),'/',MONTH(a.regdate),'/',(YEAR(a.regdate)+543)) regdate, 
                    concat(DAY(a.dchdate),'/',MONTH(a.dchdate),'/',(YEAR(a.dchdate)+543)) dchdate,  
                    a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,
                    a.dx4,a.dx5,op.bps,op.bpd
                FROM ovst ov
                left outer join an_stat a on a.an = ov.an
                left outer join opdscreen op on op.vn = ov.vn
                left outer join patient pt on pt.hn = ov.hn
                WHERE    
                    a.dchdate between $datestart  AND $dateend  AND 
                    ov.an != ''   and op.bps >= 180

                and (   a.pdx = 'I10' or 
                        a.dx0 = 'I10' or 
                        a.dx1 = 'I10' or 
                        a.dx2 = 'I10' or 
                        a.dx3 = 'I10' or 
                        a.dx4 = 'I10' or 
                        a.dx5 = 'I10' )
                GROUP BY ov.an ";

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('report5', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]); 
    }
    
    
   
     public function actionReport6($datestart, $dateend, $details) {
              // save log
        $this->SaveLog($this->dep_controller, 'report6', $this->getSession());
        
       
        $report_name = "รายงานผู้ป่วย admit sepsis";
        $sql = "SELECT 
                    a.hn,a.an,
                    concat(p.pname,p.fname,'  ',p.lname) as pt_name,
                    concat(DAY(a.regdate),'/',MONTH(a.regdate),'/',(YEAR(a.regdate)+543)) regdate, 
                    concat(DAY(a.dchdate),'/',MONTH(a.dchdate),'/',(YEAR(a.dchdate)+543)) dchdate,
                    a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5

                FROM an_stat  a
                    left outer join patient p on p.hn = a.hn
                WHERE 
                    a.dchdate between $datestart  AND $dateend
                    AND (
                        (a.pdx between 'a400' and 'a419' or a.pdx in ('r572','r651'))  or
                        (a.dx0 between 'a400' and 'a419' or a.dx0 in ('r572','r651'))  or
                        (a.dx1 between 'a400' and 'a419' or a.dx1 in ('r572','r651'))  or
                        (a.dx2 between 'a400' and 'a419' or a.dx2 in ('r572','r651'))  or
                        (a.dx3 between 'a400' and 'a419' or a.dx3 in ('r572','r651'))  or
                        (a.dx4 between 'a400' and 'a419' or a.dx4 in ('r572','r651'))  or
                        (a.dx5 between 'a400' and 'a419' or a.dx5 in ('r572','r651'))

                      )

                GROUP BY a.an ";

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
                    'report_name' => $report_name,
                    'details' => $details,
        ]); 
    }
    
    
     public function actionReport7($datestart, $dateend, $details) {
              // save log
        $this->SaveLog($this->dep_controller, 'report7', $this->getSession());
              
        $report_name = "รายงานจำนวนครั้งคนไข้(IPD) ที่มีรหัสวินิจฉัย diarrhea (A090-A099)";
        $sql = "SELECT
                    a.hn,a.an,concat(p.pname,p.fname,'  ',p.lname) as pt_name,s.name as sex,a.age_y,a.regdate ,a.dchdate,a.admdate,
                    a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5

                    FROM an_stat a
                    left outer join patient p on p.hn = a.hn
                    left outer join sex s on s.code = a.sex

                    WHERE a.dchdate between $datestart and $dateend and

                    (
                          (a.pdx between 'a090' and 'a099') or
                          (a.dx0 between 'a090' and 'a099') or
                          (a.dx1 between 'a090' and 'a099') or
                          (a.dx2 between 'a090' and 'a099') or
                          (a.dx3 between 'a090' and 'a099') or
                          (a.dx4 between 'a090' and 'a099') or
                          (a.dx5 between 'a090' and 'a099')
                    )
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

        return $this->render('report7', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]); 
    }
    
    
     public function actionReport8($datestart, $dateend, $details) {
              // save log
        $this->SaveLog($this->dep_controller, 'report8', $this->getSession());
              
        $report_name = "รายงานจำนวนครั้งไข้เลือดออก คนไข้(IPD) รหัสวินิจฉัย (A90-A919)";
        $sql = "SELECT
                    a.hn,a.an,concat(p.pname,p.fname,'  ',p.lname) as pt_name,s.name as sex,a.age_y,a.regdate ,a.dchdate,a.admdate,
                    a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5

                    FROM an_stat a
                    left outer join patient p on p.hn = a.hn
                    left outer join sex s on s.code = a.sex

                    WHERE a.dchdate between $datestart and $dateend and

                    (
                          (a.pdx between 'a90' and 'a919') or
                          (a.dx0 between 'a90' and 'a919') or
                          (a.dx1 between 'a90' and 'a919') or
                          (a.dx2 between 'a90' and 'a919') or
                          (a.dx3 between 'a90' and 'a919') or
                          (a.dx4 between 'a90' and 'a919') or
                          (a.dx5 between 'a90' and 'a919')
                    )
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

        return $this->render('report8', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]); 
    }
    
    
    
    public function actionReport9($datestart, $dateend, $details) {
              // save log
        $this->SaveLog($this->dep_controller, 'report9', $this->getSession());
              
        $report_name = "รายงานจำนวนครั้งคนไข้ไส้ติ่งอักเสบ คนไข้(IPD) รหัสวินิจฉัย (K352-K37)";
        $sql = "SELECT
                    a.hn,a.an,concat(p.pname,p.fname,'  ',p.lname) as pt_name,s.name as sex,a.age_y,a.regdate ,a.dchdate,a.admdate,
                    a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5

                    FROM an_stat a
                    left outer join patient p on p.hn = a.hn
                    left outer join sex s on s.code = a.sex

                    WHERE a.dchdate between $datestart and $dateend and

                    (
                          (a.pdx between 'k352' and 'k37') or
                          (a.dx0 between 'k352' and 'k37') or
                          (a.dx1 between 'k352' and 'k37') or
                          (a.dx2 between 'k352' and 'k37') or
                          (a.dx3 between 'k352' and 'k37') or
                          (a.dx4 between 'k352' and 'k37') or
                          (a.dx5 between 'k352' and 'k37')
                    )
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

        return $this->render('report9', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]); 
    }


    
    public function actionReport10($datestart, $dateend, $details) {
              // save log
        $this->SaveLog($this->dep_controller, 'report10', $this->getSession());
              
        $report_name = "รายงานจำนวนครั้งคนไข้ Pneumonia คนไข้(IPD) รหัสวินิจฉัย (J120-J189)";
        $sql = "SELECT
                    a.hn,a.an,concat(p.pname,p.fname,'  ',p.lname) as pt_name,s.name as sex,a.age_y,a.regdate ,a.dchdate,a.admdate,
                    a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5

                    FROM an_stat a
                    left outer join patient p on p.hn = a.hn
                    left outer join sex s on s.code = a.sex

                    WHERE a.dchdate between $datestart and $dateend and

                    (
                          (a.pdx between 'j120' and 'j189') or
                          (a.dx0 between 'j120' and 'j189') or
                          (a.dx1 between 'j120' and 'j189') or
                          (a.dx2 between 'j120' and 'j189') or
                          (a.dx3 between 'j120' and 'j189') or
                          (a.dx4 between 'j120' and 'j189') or
                          (a.dx5 between 'j120' and 'j189')
                    )
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

        return $this->render('report10', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]); 
    }

    
     public function actionReport11($datestart, $dateend, $details) {
              // save log
        $this->SaveLog($this->dep_controller, 'report11', $this->getSession());
              
        $report_name = "รายงานจำนวนครั้งคนไข้ Sepsis คนไข้(IPD) รหัสวินิจฉัย (A400 - A419,R572 , R650-R659)";
        $sql = "SELECT
                    a.hn,a.an,concat(p.pname,p.fname,'  ',p.lname) as pt_name,s.name as sex,a.age_y,a.regdate ,a.dchdate,a.admdate,
                    a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5

                    FROM an_stat a
                    left outer join patient p on p.hn = a.hn
                    left outer join sex s on s.code = a.sex

                    WHERE a.dchdate between $datestart and $dateend and

                    (
                          ((a.pdx between 'a400' and 'a419') or (a.pdx between 'r650' and 'r659' ) or (pdx = 'r572'))  or
                          ((a.dx0 between 'a400' and 'a419') or (a.dx0 between 'r650' and 'r659' ) or (dx0 = 'r572'))  or
                          ((a.dx1 between 'a400' and 'a419') or (a.dx1 between 'r650' and 'r659' ) or (dx1 = 'r572'))  or
                          ((a.dx2 between 'a400' and 'a419') or (a.dx2 between 'r650' and 'r659' ) or (dx2 = 'r572'))  or
                          ((a.dx3 between 'a400' and 'a419') or (a.dx3 between 'r650' and 'r659' ) or (dx3 = 'r572'))  or
                          ((a.dx4 between 'a400' and 'a419') or (a.dx4 between 'r650' and 'r659' ) or (dx4 = 'r572'))  or
                          ((a.dx5 between 'a400' and 'a419') or (a.dx5 between 'r650' and 'r659' ) or (dx5 = 'r572'))
                    )
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

        return $this->render('report11', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]); 
    }

    
    
    
    public function actionReport12($datestart, $dateend, $details) {
              // save log
        $this->SaveLog($this->dep_controller, 'report12', $this->getSession());
              
        $report_name = "รายงานจำนวนครั้งคนไข้(IPD) ที่มีรหัสวินิจฉัย Stroke (I600-I688),Diag Type3";
        $sql = "SELECT
                    a.hn,a.an,concat(p.pname,p.fname,'  ',p.lname) as pt_name,s.name as sex,
                    a.age_y,a.regdate ,a.dchdate,a.admdate,
                    a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5, ip.diagtype

                    FROM an_stat a
                    left outer join patient p on p.hn = a.hn
                    left outer join sex s on s.code = a.sex
                    left outer join iptdiag ip on ip.an = a.an

                    WHERE a.dchdate between $datestart and $dateend
                    and  ip.icd10 between 'i600' and 'i688'  and ip.diagtype = '3'
                    GROUP BY a.an
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

        return $this->render('report12', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]); 
    }
    
    
     public function actionReport13($datestart, $dateend, $details) {
              // save log
        $this->SaveLog($this->dep_controller, 'report13', $this->getSession());
              
        $report_name = "รายงานจำนวนครั้งคนไข้(IPD) ที่มีรหัสวินิจฉัย MI (I210-I219),Diag Type 3";
        $sql = "SELECT
                    a.hn,a.an,concat(p.pname,p.fname,'  ',p.lname) as pt_name,s.name as sex,
                    a.age_y,a.regdate ,a.dchdate,a.admdate,
                    a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5, ip.diagtype

                    FROM an_stat a
                    left outer join patient p on p.hn = a.hn
                    left outer join sex s on s.code = a.sex
                    left outer join iptdiag ip on ip.an = a.an

                    WHERE a.dchdate between $datestart and $dateend
                    and  ip.icd10 between 'i210' and 'i219'  and ip.diagtype = '3'
                    GROUP BY a.an
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

        return $this->render('report13', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]); 
    }
    
    
    public function actionReport14($datestart, $dateend, $details) {
              // save log
        $this->SaveLog($this->dep_controller, 'report14', $this->getSession());
              
        $report_name = "รายงานจำนวนครั้งคนไข้(IPD) สั่งใช้ PRC1,PRC2";
        $sql = "SELECT
                lh.lab_order_number,lh.vn,lh.hn,concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,lh.order_date,lh.confirm_report,
                lh.order_department,k.department ,ipt.an ,ipt.ward,ipt.regdate,ipt.dchdate,a.pdx
                FROM lab_head  lh
                left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                left outer join kskdepartment k ON k.depcode = lh.order_department
                left outer join ipt ipt on ipt.an = lh.vn
                left outer join patient pt on pt.hn = lh.hn
                left outer join an_stat a on a.an = ipt.an

                WHERE 
                    ipt.dchdate BETWEEN $datestart and $dateend  AND 
                    lo.lab_items_code in ('3124','3125')   AND ipt.ward = '01' AND 
                    lh.order_department = '003'
                GROUP BY lh.vn
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

        return $this->render('report14', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]); 
    }
    
    
     public function actionReport15($datestart, $dateend, $details) {
              // save log
        $this->SaveLog($this->dep_controller, 'report15', $this->getSession());
              
        $report_name = "รายงานจำนวนคนไข้ที่มี Diag Hypoglycemia และได้รับการ Admit (Diag = E162)";
        $sql = "SELECT
                    a.hn,a.an,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
                    a.regdate,a.dchdate,
                    a.pdx,a.hn,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5
                FROM an_stat a
                LEFT OUTER JOIN patient p ON p.hn = a.hn
                WHERE a.dchdate between $datestart and $dateend
                    AND (a.pdx = 'E162' OR a.dx0 = 'E162' OR a.dx1='E162' OR 
                    a.dx2='E162' OR a.dx3='E162' OR a.dx4='E162' OR a.dx5='E162')
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

        return $this->render('report15', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]); 
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

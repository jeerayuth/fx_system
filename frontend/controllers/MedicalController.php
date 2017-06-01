<?php

namespace frontend\controllers;

use Yii;
use frontend\components\CommonController;

class MedicalController extends CommonController {
    public $dep_controller = 'medical';

    public function actionReport1($datestart, $dateend, $details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report1', $this->getSession());

        $report_name = "รายงานสรุปคนไข้ OPD แยกรายเดือน";

        $sql = "SELECT

CONCAT(MONTH(v.vstdate),'-',YEAR(v.vstdate))  as vstmonth ,
COUNT(v.vn) as count_vn_opd  ,
COUNT(distinct(v.hn)) as count_hn_opd ,

(
      SELECT
            count(distinct(s.hn)) as count_hn_new_year
      FROM vn_stat s
      WHERE
           s.count_in_year = 0  and   (CONCAT(YEAR(s.vstdate),'-',MONTH(s.vstdate)) = CONCAT(YEAR(v.vstdate),'-',MONTH(v.vstdate)))
)     AS count_in_new_year,


SUM(v.income) as Income

FROM vn_stat v
WHERE  v.vstdate BETWEEN $datestart AND $dateend
GROUP BY  CONCAT(YEAR(v.vstdate),'-',MONTH(v.vstdate))
ORDER BY  v.vstdate ";


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

        $report_name = "รายงานสรุปคนไข้ IPD (IPD+LR) แยกรายเดือน";

        $sql = "SELECT

CONCAT(MONTH(a.dchdate),'-',YEAR(a.dchdate))  as group_date ,
COUNT(a.an) as count_an_ipd  ,
COUNT(distinct(a.hn)) as count_hn_ipd ,
SUM(a.admdate) as wunnon,
SUM(a.income) as income,

(
      SELECT
            count(distinct(s.hn)) as count_hn_new_year
      FROM an_stat s
      WHERE
           s.count_in_year = 0 and   (CONCAT(YEAR(s.dchdate),'-',MONTH(s.dchdate)) = CONCAT(YEAR(a.dchdate),'-',MONTH(a.dchdate)))

)     AS count_in_year

FROM an_stat a

WHERE  a.dchdate BETWEEN $datestart AND $dateend

group by  CONCAT(YEAR(a.dchdate),'-',MONTH(a.dchdate))

order by a.dchdate ";


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

        $report_name = "รายงานทะเบียนผู้เสียชีวิต";

        $sql = "SELECT

pt.hn,pt.cid,concat(pt.pname,pt.fname,'  ',pt.lname) as ptname  ,
pt.birthday,pt.deathday,  death_diag_1 as death_diag_a , death_diag_2 as death_diag_b,death_diag_3 as death_diag_c,death_diag_4 as death_diag_d

from death d  

left outer join patient pt on pt.hn = d.hn
left outer join icd101 i1 on i1.code=pt.death_diag  

where d.death_date between $datestart and $dateend ";


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

        $report_name = "รายงานตรวจสอบ RW ที่มีค่าว่าง (Null)";

        $sql = "select v.vn,v.hn,v.vstdate,o.rw,concat(p.pname,p.fname,'  ',p.lname) as pt_name

from vn_stat   v

left outer join ovst_drgs o on o.vn = v.vn
left outer join patient p on p.hn = v.hn

where v.vstdate between $datestart  and $dateend and o.rw is null

order by v.vstdate ";


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
                    'details' => $details,
        ]);
    }

    public function actionReport5($datestart, $dateend, $details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report5', $this->getSession());

        $report_name = "รายงานตรวจสอบเวชระเบียนผู้ป่วยนอก";

        $sql = "SELECT

v.vstdate,

(
  select count(n.vn) from vn_stat n where n.vstdate = v.vstdate
) as count_all_visit ,

(
  select count(s.vn) from vn_stat s

  left outer join vn_opd_complete o on o.vn = s.vn

  where s.vstdate = v.vstdate AND

  s.vn  in (select vn from vn_opd_complete where complete = 'Y')
)  as count_folder_complete  ,


(
   select count(distinct(s.vn)) from vn_stat s
  left outer join vn_opd_complete o on o.vn = s.vn
  left outer join ksklog k on k.detail = s.vn
  where s.vstdate = v.vstdate  AND  Time(k.logtime) >= '07:00:00' AND Time(k.logtime) <= '15:30:00'  AND k.loginname = 'ศุภนารี' AND s.vn  in (select vn from vn_opd_complete where complete = 'Y')
) as count_in_time ,


(
   SELECT count(distinct(s.vn))  FROM vn_stat s

  left outer join vn_opd_complete o on o.vn = s.vn

  left outer join ksklog k on k.detail = s.vn

  WHERE s.vstdate =  v.vstdate   AND  Time(k.logtime) >= '07:00:00' AND   
  
  Time(k.logtime) <= '15:30:00'  AND k.loginname = 'ศุภนารี'
  
  AND s.vstdate != DATE(k.logtime)  AND  s.vn = k.detail

  AND s.vn  in (select vn from vn_opd_complete where complete = 'Y')

) as difference_date_receive, 

(
     SELECT count(distinct(s.vn))  FROM vn_stat  s

    LEFT OUTER JOIN ovst_drgs o ON o.vn = s.vn

    WHERE s.vstdate = v.vstdate  AND o.rw = 0

)  as count_rw_o, 

(
     SELECT count(distinct(s.vn))  FROM vn_stat  s

    WHERE s.vstdate = v.vstdate  AND s.pdx=''

)  as count_pdx_empty

FROM vn_stat v
WHERE v.vstdate between $datestart and $dateend
GROUP BY v.vstdate
ORDER BY v.vstdate ";


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
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }
    
    public function actionReport6($details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report6', $this->getSession());

        $report_name = "รายงานตรวจสอบคนไข้นอกเขต รพ.ละแม แต่ลง Typearea เป็นคนในเขต";

        $sql = "SELECT p.hn,concat(p.pname,p.fname,'   ',p.lname) as pt_name,
            concat(p.addrpart,' ม.',p.moopart,' ', t.full_name) as full_address,p.type_area
        FROM patient    p
        LEFT OUTER JOIN thaiaddress t on t.addressid = concat(p.chwpart,p.amppart,p.tmbpart)
        WHERE concat(p.chwpart,p.amppart,p.tmbpart) = 860501
        and p.moopart not in (1,2,3,4,5,6,7,9,10,12,14)  and p.type_area = 1";


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
    
    
    
    public function actionReport7($details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report7', $this->getSession());

        $report_name = "รายงานตรวจสอบ => คนไข้ 1 CID แต่มีหลาย HN";

        $sql = "SELECT 
                    cid,hn,concat(pname,fname,'  ',lname) as pt_name, count(hn) as c_hn
                FROM patient
                GROUP BY cid
                HAVING   count(hn) >=2 ";

            
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
    
    
    
    public function actionReport8($details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report8', $this->getSession());

        $report_name = "รายงานตรวจสอบ => คำนำหน้ากับเพศ ไม่สัมพันธ์กัน";

        $sql = "SELECT
                p.cid,p.hn,p.pname,concat(p.fname,'  ',p.lname) as  pt_name,p.type_area ,
                s.name as sex
            FROM patient p
            left JOIN sex s ON s.code = p.sex
            left JOIN pname pn on pn.name = p.pname

            WHERE   
                if(p.sex = 1,pn.provis_code in ('002','004','005'),null) or if(p.sex = 2,pn.provis_code in ('001','003','832','831'),null)
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
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
             
    }
    
    
    public function actionReport9($datestart, $dateend,$details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report9', $this->getSession());

        $report_name = "รายงานตรวจสอบ => ยืม-คืน Chart ผู้ป่วยใน";

        $sql = "
                SELECT
                    'จำนวนที่ยังไม่คืน' as text,count(an) as count_an, '1' as type_id
                FROM ipdrent  i  
                WHERE rent_date BETWEEN $datestart AND $dateend and checkin = 'N'
                and return_date is null

                UNION

                SELECT
                    'จำนวนที่คืนแล้ว' as text,count(an) as count_an, '2' as type_id
                FROM ipdrent  i  
                WHERE rent_date BETWEEN $datestart AND $dateend and checkin = 'Y'
                and return_date is not null ";

            
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
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
                    'datestart' => $datestart,
                    'dateend' => $dateend
        ]);
        
        
    }
    
    
    public function actionReport10($type_id,$datestart, $dateend) {
                // save log
        $this->SaveLog($this->dep_controller, 'report10', $this->getSession());

        $report_name = "";
        
        if($type_id == 1) {
            $report_name = "รายงานตรวจสอบ => ยืม-คืน Chart ผู้ป่วยใน (ยังไม่คืน)";
             $sql = "
                SELECT
                    i.*, if(i.return_date is null,date_add(i.rent_date,interval 4 day),i.return_date) as return_date,
                    o.name as user_fullname
                FROM ipdrent  i  
                LEFT OUTER JOIN opduser o ON o.loginname = i.rent_user
                WHERE rent_date BETWEEN $datestart AND $dateend and checkin = 'N'
                and return_date is null ";
             
        } else if ($type_id == 2) {
            $report_name = "รายงานตรวจสอบ => ยืม-คืน Chart ผู้ป่วยใน (คืนแล้ว)";
            $sql = "SELECT
                    i.*,o.name as user_fullname
                FROM ipdrent  i  
                LEFT OUTER JOIN opduser o ON o.loginname = i.rent_user
                WHERE rent_date BETWEEN $datestart AND $dateend and checkin = 'Y'
                and return_date is not null ";
        }
        
        
        
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
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'type_id' => $type_id,
 
        ]);
                
    }
    
    
    
    public function actionReport11($pttype,$datestart, $dateend,$details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report11', $this->getSession());
    
            $report_name = "รายงานผู้มารับบริการ(OPD) แยกตามสิทธิ์การรักษา";
             $sql = "SELECT
                        concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vstdate_thai,
                        v.vn,v.hn,concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
                        se.name as sex_name,v.age_y,v.pttype,pp.name as pttype_name ,
                        v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5
                  FROM vn_stat  v
                  LEFT OUTER JOIN patient pt ON pt.hn = v.hn
                  LEFT OUTER JOIN pttype pp ON pp.pttype = v.pttype
                  LEFT OUTER JOIN sex se ON se.code = v.sex

                  WHERE v.vstdate BETWEEN $datestart AND $dateend AND v.pttype=$pttype ";
                
        
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
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }


}

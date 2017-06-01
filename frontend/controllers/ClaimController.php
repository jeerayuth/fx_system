<?php

namespace frontend\controllers;

use Yii;
use frontend\components\CommonController;

class ClaimController extends CommonController {
    public $dep_controller = 'claim';

    public function actionReport1($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report1', $this->getSession());

        $report_name = "รายงานจำนวนคนไข้จ่ายค่าธรรมเนียม 30 บาท(เฉพาะสิทธิ์ 89,52,56)";
        $sql = "SELECT
            v.vn,v.hn,v.cid,
            concat(p.pname,p.fname,'  ',p.lname) as patient_name ,
            v.pttype,pp.name as pttype_name,concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vstdate  
        FROM vn_stat v	
        LEFT OUTER JOIN patient p ON p.hn = v.hn
        LEFT OUTER JOIN pttype pp ON pp.pttype = v.pttype
        WHERE 
            v.pttype in ('89','52','56') 
        AND 
            v.vstdate between $datestart and $dateend 
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

        $report_name = "จำนวนคนไข้ตามสิทธิ์ UC ทั้งหมด";
        $sql = "SELECT
	v.vn,v.hn,v.cid,
	concat(p.pname,p.fname,'  ',p.lname) as patient_name ,
	v.pttype,v.pcode,concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vstdate,pp.name as pttype_name   
        FROM 
            vn_stat v
        LEFT OUTER JOIN patient p ON p.hn = v.hn
        LEFT OUTER JOIN pttype pp ON pp.pttype = v.pttype
        WHERE 
            v.pcode NOT IN('A1','A2','A7','A8','A9','AL') 
        AND 
            v.vstdate BETWEEN $datestart and $dateend ";

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
    
    public function actionReport3($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report3', $this->getSession());

        $report_name = "รายงานพม่า (ที่มีรหัสวินิจฉัยหลักเป็น Z008,Z000)";
        $sql = "SELECT  v.vn,v.hn,concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vstdate ,v.hospmain ,p.cid,p.pname,concat(p.fname,'  ',p.lname) as pt_name,p.birthday ,p.nationality ,
        n.name as nation_name ,s.name as sex_name,p.informaddr  ,p.informname,p.informname ,p.hometel,
		dr.name as doc_name, st.service5 as startexam, 'แรงงาน' as type_name

        FROM vn_stat v
        left outer join ovst ov on ov.vn = v.vn
        left outer join service_time st on st.vn = v.vn
        left outer join doctor dr on dr.code=ov.doctor
        left outer join patient p on p.hn = v.hn
        left outer join nationality n on n.nationality = p.nationality
        left outer join sex s on s.code = p.sex
        WHERE   v.vstdate between $datestart and $dateend
        and v.pdx in ('Z008','Z000') and p.nationality!=99 and v.pttype in ('42', '43', '44','45') 
        ORDER BY v.vstdate,st.service5 ";

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

        $report_name = "รายงานประกันสังคมผู้ป่วยนอก";
        $sql = "SELECT concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name
                ,v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1,'  ',v.dx2,'  ',v.dx3,'  ',v.dx4,'  ',v.dx5) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money,
                ov.vsttime as vst_time,v.inc12 as v_drug,v.inc04 as v_xray,v.inc01 as v_lab,
                (v.inc06+v.inc07+v.inc13) as v_icd9,
                (v.inc05+v.inc09+v.inc02+v.inc03+v.inc08+v.inc11+v.inc14+v.inc15+v.inc16+v.inc17) as v_other
            FROM vn_stat v
            left outer join patient p on p.hn=v.hn 
            left outer join ovst ov on ov.vn=v.vn 
            left outer join icd101 ic on ic.code=v.pdx
            left outer join doctor dr on dr.code=ov.doctor
            left outer join sex s on s.code=v.sex 
            where  v.pcode='A7' and v.vstdate between $datestart and $dateend  and pdx not like 'z35%' and pdx not like 'z36%'
            and pdx  not in('z32','z320','z321','z33','z34','z340','z348','z349') and pdx <>'' and pdx not like '%xx%' and pdx is not null
            and v.hn not in (select distinct(d.hn) from dtmain d where d.vn = v.vn) 
            GROUP BY v.vn 
            ORDER BY v.vstdate,v.hn ";

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

        $report_name = "รายงานประกันสังคมผู้ป่วยใน";
        $sql = " SELECT 
                    p.cid,a.an,concat(DAY(a.regdate),'/',MONTH(a.regdate),'/',(YEAR(a.regdate)+543)) as regdate,
                    concat(DAY(a.dchdate),'/',MONTH(a.dchdate),'/',(YEAR(a.dchdate)+543)) as dchdate,
                    a.hn,a.vn,concat(DAY(a.regdate),'/',MONTH(a.regdate),'/',(YEAR(a.regdate)+543)) as ovst_date,
                    concat(p.pname,p.fname,'  ',p.lname) as patient_name, 
                    s.name as sex,a.age_y,concat(a.pdx,'  ',a.dx0,'  ',a.dx1) as icd10,
                    concat(a.op0,'  ',a.op1) as icd9,dr.name as doc_name,dr.licenseno,a.item_money, i.rw 
                FROM an_stat a 
                    left outer join patient p on p.hn=a.hn 
                    left outer join ovst ov on ov.vn=a.vn
                    left outer join doctor dr on dr.code=ov.doctor 
                    left outer join sex s on s.code=a.sex 
                    left outer join ipt i on i.an = a.an  

                WHERE  a.pcode='A7' and a.regdate between $datestart and $dateend and a.pdx not between 'k000' and  'k089' and pdx !='o800' and pdx!= 'z370' and pdx not like 'z35%' and pdx not like 'z36%' 
                and pdx  not in('z32','z320','z321','z33','z34','z340','z348','z349')  and pdx <>'' and pdx not like '%xx%' and pdx is not null 
                GROUP BY a.vn order by a.regdate,a.hn  ";

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

        $report_name = "ประกันสังคมผู้ป่วยนอก สุราษฎร์ธานี";
        $sql = "SELECT concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name
                ,v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1,'  ',v.dx2,'  ',v.dx3,'  ',v.dx4,'  ',v.dx5) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,ov.vsttime as vst_time,v.income,v.paid_money,remain_money,uc_money,item_money,
                v.inc12 as v_drug,v.inc04 as v_xray,v.inc01 as v_lab,(v.inc06+v.inc07+v.inc13) as v_icd9 ,(v.inc05+v.inc09+v.inc02+v.inc03+v.inc08+v.inc11+v.inc14+v.inc15+v.inc16+v.inc17) as v_other 
            FROM vn_stat v 
                left outer join patient p on p.hn=v.hn 
                left outer join ovst ov on ov.vn=v.vn 
                left outer join icd101 ic on ic.code=v.pdx 
                left outer join doctor dr on dr.code=ov.doctor 
                left outer join sex s on s.code=v.sex 
            WHERE  v.pttype='32' and v.vstdate between $datestart and $dateend  and pdx not like 'z35%' and pdx not like 'z36%'
                and pdx  not in('z32','z320','z321','z33','z34','z340','z348','z349') and pdx <>'' and pdx not like '%xx%' and pdx is not null

            and v.hn not in (select distinct(d.hn) from dtmain d where d.vn = v.vn and icd !='Z012')
            GROUP BY v.vn order by v.vstdate,v.hn  ";

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

        $report_name = "ประกันสังคมชุมพร เรื้อรัง";
        $sql = "SELECT

        concat(pt.pname,pt.fname,'   ',pt.lname) as ptname,pt.cid,pt.hn,concat(DAY(ov.vstdate),'/',MONTH(ov.vstdate),'/',(YEAR(ov.vstdate)+543)) as vst_date,
        ov.pdx,ov.dx0,ov.dx1,ov.dx2,ov.dx3,ov.dx4,ov.dx5,ov.inc_drug,ov.inc03,
        ov.inc04,ov.dx_doctor, d.licenseno, d.name as doctor_name , ov.income,

        ov.inc12,

        (ov.inc02+ov.inc03+ov.inc04+ov.inc05+ov.inc06+
        ov.inc07+ov.inc08+ov.inc09+ov.inc10+ov.inc11+
        ov.inc13+ov.inc14+ov.inc15+ov.inc16) as other_income ,

        ov.inc01, ov.income

        FROM vn_stat ov ,patient pt ,ovst ovst, doctor d

        WHERE  ov.vn=ovst.vn and pt.hn=ov.hn and ov.vstdate between $datestart and $dateend

        and  dx_doctor = d.code
        and ov.pttype='31'

        and ((ov.pdx like 'b2%')
        or (ov.dx0 like 'b2%') 
        or (ov.dx1 like 'b2%') 
        or (ov.dx2 like 'b2%') 
        or (ov.dx3 like 'b2%') 
        or (ov.dx4 like 'b2%') 
        or (ov.dx5 like 'b2%') 
        or (ov.pdx like 'e1%') 
        or (ov.dx0 like 'e1%') 
        or (ov.dx1 like 'e1%') 
        or (ov.dx2 like 'e1%') 
        or (ov.dx3 like 'e1%') 
        or (ov.dx4 like 'e1%') 
        or (ov.dx5 like 'e1%') 
        or (ov.pdx like 'e78%')
        or (ov.dx0 like 'e78%')
        or (ov.dx1 like 'e78%')
        or (ov.dx2 like 'e78%')
        or (ov.dx3 like 'e78%')
        or (ov.dx4 like 'e78%')
        or (ov.dx5 like 'e78%')
        or (ov.pdx like 'e78%')
        or (ov.dx0 like 'e05%')
        or (ov.dx1 like 'e05%')
        or (ov.dx2 like 'e05%')
        or (ov.dx3 like 'e05%')
        or (ov.dx4 like 'e05%')
        or (ov.dx5 like 'e05%')
        or (ov.pdx like 'i1%') 
        or (ov.dx0 like 'i1%') 
        or (ov.dx1 like 'i1%') 
        or (ov.dx2 like 'i1%') 
        or (ov.dx3 like 'i1%') 
        or (ov.dx4 like 'i1%') 
        or (ov.dx5 like 'i1%')


        or (ov.pdx like 'i64')
        or (ov.dx0 like 'i64')
        or (ov.dx1 like 'i64')
        or (ov.dx2 like 'i64')
        or (ov.dx3 like 'i64')
        or (ov.dx4 like 'i64')
        or (ov.dx5 like 'i64')

        or (ov.pdx like 'i698')
        or (ov.dx0 like 'i698')
        or (ov.dx1 like 'i698')
        or (ov.dx2 like 'i698')
        or (ov.dx3 like 'i698')
        or (ov.dx4 like 'i698')
        or (ov.dx5 like 'i698')

        or (ov.pdx like 'n18%') 
        or (ov.dx0 like 'n18%') 
        or (ov.dx1 like 'n18%') 
        or (ov.dx2 like 'n18%') 
        or (ov.dx3 like 'n18%') 
        or (ov.dx4 like 'n18%') 
        or (ov.dx5 like 'n18%') 
        or (ov.pdx like 'c0%') 
        or (ov.dx0 like 'c0%') 
        or (ov.dx1 like 'c0%') 
        or (ov.dx2 like 'c0%') 
        or (ov.dx3 like 'c0%') 
        or (ov.dx4 like 'c0%') 
        or (ov.dx5 like 'c0%') 
        or (ov.pdx like 'c1%') 
        or (ov.dx0 like 'c1%') 
        or (ov.dx1 like 'c1%') 
        or (ov.dx2 like 'c1%') 
        or (ov.dx3 like 'c1%') 
        or (ov.dx4 like 'c1%') 
        or (ov.dx5 like 'c1%') 
        or (ov.pdx like 'c2%') 
        or (ov.dx0 like 'c2%') 
        or (ov.dx1 like 'c2%') 
        or (ov.dx2 like 'c2%') 
        or (ov.dx3 like 'c2%') 
        or (ov.dx4 like 'c2%') 
        or (ov.dx5 like 'c2%') 
        or (ov.pdx like 'c3%') 
        or (ov.dx0 like 'c3%') 
        or (ov.dx1 like 'c3%') 
        or (ov.dx2 like 'c3%') 
        or (ov.dx3 like 'c3%') 
        or (ov.dx4 like 'c3%') 
        or (ov.dx5 like 'c3%') 
        or (ov.pdx like 'c4%') 
        or (ov.dx0 like 'c4%') 
        or (ov.dx1 like 'c4%') 
        or (ov.dx2 like 'c4%') 
        or (ov.dx3 like 'c4%') 
        or (ov.dx4 like 'c4%') 
        or (ov.dx5 like 'c4%') 
        or (ov.pdx like 'c5%') 
        or (ov.dx0 like 'c5%') 
        or (ov.dx1 like 'c5%') 
        or (ov.dx2 like 'c5%') 
        or (ov.dx3 like 'c5%') 
        or (ov.dx4 like 'c5%') 
        or (ov.dx5 like 'c5%') 
        or (ov.pdx like 'c6%') 
        or (ov.dx0 like 'c6%') 
        or (ov.dx1 like 'c6%') 
        or (ov.dx2 like 'c6%') 
        or (ov.dx3 like 'c6%') 
        or (ov.dx4 like 'c6%') 
        or (ov.dx5 like 'c6%') 
        or (ov.pdx like 'c7%') 
        or (ov.dx0 like 'c7%') 
        or (ov.dx1 like 'c7%') 
        or (ov.dx2 like 'c7%') 
        or (ov.dx3 like 'c7%') 
        or (ov.dx4 like 'c7%') 
        or (ov.dx5 like 'c7%') 
        or (ov.pdx like 'c8%') 
        or (ov.dx0 like 'c8%') 
        or (ov.dx1 like 'c8%') 
        or (ov.dx2 like 'c8%') 
        or (ov.dx3 like 'c8%') 
        or (ov.dx4 like 'c8%') 
        or (ov.dx5 like 'c8%') 
        or (ov.pdx like 'c9%') 
        or (ov.dx0 like 'c9%') 
        or (ov.dx1 like 'c9%') 
        or (ov.dx2 like 'c9%') 
        or (ov.dx3 like 'c9%') 
        or (ov.dx4 like 'c9%') 
        or (ov.dx5 like 'c9%'))
       ORDER BY ov.vstdate ";

 

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

        $report_name = "ประกันสังคมทันตกรรม";
        $sql = "select p.cid,d.hn,d.vn,concat(DAY(d.vstdate),'/',MONTH(d.vstdate),'/',(YEAR(d.vstdate)+543)) as vst_date,concat(p.pname,p.fname,'  ',p.lname) as patient_name,p.fname as FName,p.lname as LName,
                concat(DAY(p.birthday),'/',MONTH(p.birthday),'/',(YEAR(p.birthday)+543)) as Birth_date, 
                i.code as icd10,i.name as icd_name,d.ttcode,dr.name as doctor,v.income,dm.name as tmcode_name 
                from dtmain d 
                left outer join doctor dr on dr.code=d.doctor
                left outer join patient p on p.hn=d.hn 
                left outer join icd101 i on i.code=d.icd 
                left outer join vn_stat v on v.vn=d.vn 
                left outer join dttm dm on dm.code=d.tmcode 
                where  v.pcode='A7' and d.vstdate between $datestart and $dateend
                group by d.vn order by d.vstdate ";

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

        $report_name = "ประกันสังคม ANC ผู้ป่วยนอก";
        $sql = "SELECT 
                    p.cid,v.hn,v.vn,concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as ovst_date,concat(p.pname,p.fname,'  ',p.lname) as patient_name
                    ,s.name as sex,v.age_y,concat(v.pdx,'  ',v.dx0,'  ',v.dx1,'  ',v.dx2,'  ',v.dx3,'  ',v.dx4,'  ',v.dx5) as icd10,
                    concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,        
                    if(v.item_money>700,700,v.item_money) as item_money
                    

                FROM vn_stat v 
                    left outer join patient p on p.hn=v.hn 
                    left outer join ovst ov on ov.vn=v.vn 
                    left outer join doctor dr on dr.code=ov.doctor
                    left outer join sex s on s.code=v.sex 
                WHERE  
                    v.pcode='A7' and v.vstdate between $datestart and $dateend  and pdx not like 'k%'
                    and (pdx like 'z35%' or pdx like 'z36%' 
                    or pdx  in('z32','z320','z321','z33','z34','z340','z348','z349'))   
                    and p.pname not like '%?.?%'  and pdx <>'' and pdx not like '%xx%' and pdx is not null 
                GROUP BY v.vn order by v.vstdate,v.hn ";

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

        $report_name = "สิทธิ์บัตรประกันสุขภาพถ้วนหน้า(UC) มีท,ไม่มีท เขตรอยต่อ(รวมผลวินิจฉัย E100 - E119 และ I10)";
        $sql = "SELECT 
                    concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name
                    ,v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1,'  ',v.dx2,'  ',v.dx3,'   ',v.dx4,'  ',v.dx5) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money
                FROM vn_stat v
                    left outer join patient p on p.hn=v.hn 
                    left outer join ovst ov on ov.vn=v.vn 
                    left outer join icd101 ic on ic.code=v.pdx 
                    left outer join doctor dr on dr.code=ov.doctor 
                    left outer join sex s on s.code=v.sex 
                WHERE
                    v.pcode='UC' and v.vstdate between $datestart and $dateend
                    and v.pttype in('52','54')
                    and pdx !=''  and pdx is not null
                    group by v.vn order by v.vstdate,v.hn ";

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

        $report_name = "รายงานสิทธิ์บัตรประกันสุขภาพถ้วนหน้า(UC) มีท,ไม่มีท เขตรอยต่อ (ผลวินิจฉัย E100 - E119,I10)";
        $sql = "select 
                    concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name
                    ,v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1,'  ',v.dx2,'  ',v.dx3,'  ',v.dx4,'  ',v.dx5) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money 
                FROM vn_stat v 
                    left outer join patient p on p.hn=v.hn 
                    left outer join ovst ov on ov.vn=v.vn 
                    left outer join icd101 ic on ic.code=v.pdx 
                    left outer join doctor dr on dr.code=ov.doctor 
                    left outer join sex s on s.code=v.sex 
                WHERE  v.pcode='UC' and v.vstdate between $datestart and $dateend
                    and v.pttype in('52','54')
                    and((pdx between 'E100' and 'E119' )or(pdx='I10')
                    or ( dx0 between 'E100' and 'E119' )or(dx0='I10')
                    or ( dx1 between 'E100' and 'E119' )or(dx1='I10')
                    or ( dx2 between 'E100' and 'E119' )or(dx2='I10')
                    or ( dx3 between 'E100' and 'E119' )or(dx3='I10')
                    or ( dx4 between 'E100' and 'E119' )or(dx4='I10')
                    or ( dx5 between 'E100' and 'E119' )or(dx5='I10'))
                    and pdx !=''  and pdx is not null
                GROUP BY v.vn order by v.vstdate,v.hn ";

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

        $report_name = "รายงานคนไข้ที่ใช้สิทธิ์โครงการจ่ายตรง (ผู้ป่วยนอก)";
        $sql = "
                SELECT 
                    concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name
                    ,v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money
                FROM vn_stat v
                    left outer join patient p on p.hn=v.hn
                    left outer join ovst ov on ov.vn=v.vn
                    left outer join icd101 ic on ic.code=v.pdx
                    left outer join doctor dr on dr.code=ov.doctor
                    left outer join sex s on s.code=v.sex
                WHERE
                    v.pcode='A2' and v.vstdate between $datestart and $dateend
                    and v.pttype in('11')
                GROUP BY v.vn 
                ORDER BY v.vstdate,v.hn ";

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

        $report_name = "รายงานคนไข้ที่ใช้สิทธิ์ อปท.เข้าโครงการจ่ายตรง (ผู้ป่วยนอก)";
        $sql = "SELECT 
                    concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name
                    ,v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,
                    v.income,v.paid_money,remain_money,uc_money,item_money
                FROM vn_stat v
                    left outer join patient p on p.hn=v.hn
                    left outer join ovst ov on ov.vn=v.vn
                    left outer join icd101 ic on ic.code=v.pdx
                    left outer join doctor dr on dr.code=ov.doctor
                    left outer join sex s on s.code=v.sex
                WHERE  
                    v.pcode = 'A2' and v.vstdate between $datestart and $dateend
                    and v.pttype in('14')
                GROUP BY v.vn                   
                ORDER BY v.vstdate,v.hn ";
                
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

        $report_name = "รายงาน คนไข้ ที่ใช้สิทธิ์ โครงการจ่ายตรง (ผู้ป่วยใน)";
        $sql = "SELECT
                    p.cid,a.an,a.hn,a.vn,concat(DAY(a.dchdate),'/',MONTH(a.dchdate),'/',(YEAR(a.dchdate)+543)) as ovst_date,
                    concat(p.pname,p.fname,'  ',p.lname) as patient_name
                    ,s.name as sex,a.age_y,concat(a.pdx,'  ',a.dx0,'  ',a.dx1,'  ',a.dx2,'  ',a.dx3,'  ',a.dx4,'  ',a.dx5) as icd10,
                    concat(a.op0,'  ',a.op1) as icd9,dr.name as doc_name,dr.licenseno,a.item_money
                FROM an_stat a
                    left outer join patient p on p.hn=a.hn
                    left outer join ovst ov on ov.vn=a.vn
                    left outer join doctor dr on dr.code=ov.doctor
                    left outer join sex s on s.code=a.sex
                WHERE a.dchdate between $datestart and $dateend
                    and pdx!='' and pdx is not null
                    and a.pttype in('11')
                GROUP BY a.vn 
                ORDER BY a.dchdate,a.hn ";

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

        $report_name = "E-Claim ผู้ป่วยนอก สิทธิ์ 56(UC นอกเขตต่างจังหวัดไม่มีท),57(UC ท นอกเขตต่างจังหวัดมี ท)";
        $sql = "SELECT
                    concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name
                    ,v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1,'  ',v.dx2,'  ',v.dx3,'  ',v.dx4,'  ',v.dx5) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,
                    dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money
                FROM vn_stat v
                    left outer join patient p on p.hn=v.hn
                    left outer join ovst ov on ov.vn=v.vn
                    left outer join icd101 ic on ic.code=v.pdx
                    left outer join doctor dr on dr.code=ov.doctor
                    left outer join sex s on s.code=v.sex
                WHERE  
                    v.vstdate between $datestart and $dateend
                    and v.pttype in('56','57')
                GROUP BY v.vn 
                ORDER BY v.vstdate,v.hn ";

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

        $report_name = "รายงานตรวจสอบข้อมูลประกันสังคมผู้ป่วยนอก (ที่ยังไม่ลง diag หลัก)";
        $sql = "SELECT
                    concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name
                    ,v.cid,s.name as sex,v.age_y,'' as icd10,
                    concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money
                FROM vn_stat v
                    left outer join patient p on p.hn=v.hn
                    left outer join ovst ov on ov.vn=v.vn
                    left outer join icd101 ic on ic.code=v.pdx
                    left outer join doctor dr on dr.code=ov.doctor
                    left outer join sex s on s.code=v.sex
                WHERE  
                    v.pcode='A7' and v.vstdate between $datestart and $dateend
                    and (pdx =''  or pdx is null)
                    and v.hn not in (select distinct(d.hn) from dtmain d where d.vn = v.vn)
                GROUP BY v.vn 
                ORDER BY v.vstdate,v.hn";

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

        $report_name = "รายงานตรวจสอบสิทธิ์บัตรประกันสุขภาพถ้วนหน้า(UC) มีท,ไม่มีท เขตรอยต่อ (ที่ยังไม่ได้ลง diag)";
        $sql = "
                select
                concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,
                v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name,
                v.cid,s.name as sex,v.age_y,'' as icd10,
                concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money

                from vn_stat v
                left outer join patient p on p.hn=v.hn
                left outer join ovst ov on ov.vn=v.vn
                left outer join icd101 ic on ic.code=v.pdx
                left outer join doctor dr on dr.code=ov.doctor
                left outer join sex s on s.code=v.sex
                where  v.pcode='UC' and v.vstdate between $datestart and $dateend and v.pttype in('52','54')
                and (pdx =''  or pdx is null)
                group by v.vn order by v.vstdate,v.hn";

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
     
     
     public function actionReport18($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report18', $this->getSession());

        $report_name = "รายงานคนไข้ที่มีการบันทึก Typearea เป็น Type3 ในฝั่งข้อมูลประชากร(Person)";
        $sql = "select 
                    p.cid,p.hn,concat(p.pname,p.fname,p.lname) as pt_name,
                    p.addrpart,p.moopart, t.full_name,p.hometel,person.house_regist_type_id,h.house_regist_type_name,
                    (
                        select count(distinct(o.vn)) from ovst o where o.hn = p.hn  and o.vstdate between '2015-10-01' and '2016-09-30'
                    ) as count_vn_59,
                    (
                        select count(distinct(o.vn)) from ovst o where o.hn = p.hn  and o.vstdate between '2014-10-01' and '2015-09-30'
                    ) as count_vn_58

                    from person

                    left outer join patient p on p.cid = person.cid
                    left outer join house_regist_type h on h.house_regist_type_id = person.house_regist_type_id
                    left outer join thaiaddress t on t.addressid = concat(p.chwpart,p.amppart,p.tmbpart)

                    where person.house_regist_type_id = '3'  and person.cid != '' and p.cid != ''   and t.full_name != ''

                    order by p.chwpart,p.amppart,p.tmbpart,p.moopart ";



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
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
     }
     
     public function actionReport19($datestart, $dateend, $details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report19', $this->getSession());

        $report_name = "รายงานผู้ป่วย OPD ในเขตตำบลละแม (หมู่1-7,9,10,12,14) มีรหัสวินิจฉัยหลัก เป็น z515";
        $sql = " 
                SELECT
                       concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vstdate_thai,
                       v.hn,concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
                       v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5,
                       v.moopart,th.full_name,v.income
                FROM vn_stat v
                LEFT OUTER JOIN patient pt on pt.hn = v.hn
                LEFT OUTER JOIN thaiaddress th on th.addressid = v.aid
                WHERE
                      v.vstdate BETWEEN $datestart AND $dateend AND v.pdx = 'z515' AND
                      v.aid = '860501' AND v.moopart IN (1,2,3,4,5,6,7,9,10,12,14)
                ORDER BY v.aid,v.moopart  ";
                               

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
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
     }
     
     
     
     
}

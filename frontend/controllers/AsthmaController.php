<?php

namespace frontend\controllers;

use Yii;
use frontend\components\CommonController;


class AsthmaController extends CommonController {
    public $dep_controller = 'asthma';

    public function actionReport1() {
                // save log
        $this->SaveLog($this->dep_controller, 'report1', $this->getSession());

        $report_name = "รายงานสรุปคนไข้ทะเบียนคลินิกหอบหืดแยกตามที่อยู่";
        $sql = "         
SELECT 
th.addressid,th.name as tumbol , th.full_name as address,count(distinct(cm.hn)) as count_hn
FROM clinicmember  cm
LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
WHERE 
    cm.clinic = '019'
AND pd.code in('3','03')
GROUP BY th.addressid 
ORDER BY count(distinct(cm.hn)) DESC ";

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
        ]);
    }

    /* รายงานสรุปคนไข้ทะเบียนคลินิกหอบหืดแยกตามที่อยู่ (แสดงรายชื่อคนไข้) */
    public function actionReport2($addressid) {
                // save log
        $this->SaveLog($this->dep_controller, 'report2', $this->getSession());

        $report_name = "รายงานสรุปคนไข้ทะเบียนคลินิกหอบหืดแยกตามที่อยู่";

        $sql = "         
SELECT
pt.hn as hn,concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
concat( timestampdiff(year,pt.birthday,now()), ' ปี') as age_y,
pt.cid,cm.regdate,cm.begin_year,
concat(pt.addrpart,' ม.',pt.moopart,' ',th.full_name) address,
pt.moopart
FROM clinicmember  cm
LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
WHERE 
     cm.clinic = '019'
AND pd.code in('3','03')
AND concat(pt.chwpart,pt.amppart,pt.tmbpart) = '$addressid'
GROUP BY pt.hn     
ORDER BY pt.moopart,age_y

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

        return $this->render('report2', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
        ]);
    }
    
    
    
    public function actionReport3($datestart, $dateend, $details) {
                // save log
        $this->SaveLog($this->dep_controller, 'report3', $this->getSession());

        $report_name = "รายงานจำนวนคนไข้คลินิกหอบหืด ได้รับการคัดกรองการสูบบุหรี่-ดื่มสุรา";

        $sql = "select os.hn, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,v.age_y as age_y,
                s.name as sex, os.bmi, st.smoking_type_name ,dt.drinking_type_name, 
                v.moopart,t.full_name as address, os.vstdate

from opdscreen os
left outer join vn_stat v on v.vn=os.vn
left outer join smoking_type st on st.smoking_type_id=os.smoking_type_id
left outer join drinking_type dt on dt.drinking_type_id=os.drinking_type_id
left outer join patient pt on pt.hn=os.hn
left outer join clinicmember cm on cm.hn=os.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code=cs.provis_typedis
left OUTER join thaiaddress t on t.addressid=v.aid
left outer join sex s on s.code = pt.sex

where 
	os.vstdate between $datestart and $dateend and  os.smoking_type_id !=0 and dt.drinking_type_id !=0 
and 
	cm.clinic = '019'
group by os.hn
order by v.aid, v.moopart, os.hn, os.vstdate ";

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => False,
        ]);

        return $this->render('report3', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    } // จบ function
    
    
    
     public function actionReport4($datestart, $dateend, $details) {
                         // save log
        $this->SaveLog($this->dep_controller, 'report4', $this->getSession());

        $report_name = "รายงานจำนวนคนไข้คลินิกหอบหืด ได้รับบริการที่ห้องฉุกเฉิน";

        $sql = "select
v.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
v.age_y,s.name as sex, v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5 ,c.clinic,v.vstdate,
v.moopart,t.full_name as address

from vn_stat  v

left outer join clinicmember c on c.hn = v.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=c.clinic_member_status_id
left outer join provis_typedis pd on pd.code=cs.provis_typedis
right outer join er_regist e on e.vn = v.vn
left outer join patient p on p.hn = v.hn
left OUTER join thaiaddress t on t.addressid=v.aid
left outer join sex s on s.code = p.sex

where 
v.vstdate between $datestart and $dateend
and c.clinic = '019' /* and c.clinic_member_status_id=1 */
and v.pdx between 'J450' and 'J46'

group by v.hn
order by v.aid, v.moopart, v.hn, v.vstdate ";

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => False,
        ]);

        
        return $this->render('report4', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    } // จบ function
    
       
       public function actionReport5($datestart, $dateend, $details) {
                           // save log
        $this->SaveLog($this->dep_controller, 'report5', $this->getSession());

        $report_name = "รายงานจำนวนคนไข้คลินิกหอบหืด ได้รับการ Admit";

        $sql = "select o.hn,o.an,concat(p.pname,p.fname,'  ',p.lname) as pt_name,v.age_y,s.name as sex,
            v.age_y,s.name as sex,o.vstdate, v.moopart,t.full_name as address

from ovst  o

left outer join clinicmember c on c.hn = o.hn
left outer join patient p on p.hn = o.hn
left outer join vn_stat v on v.vn = o.vn
left OUTER join thaiaddress t on t.addressid=v.aid
left outer join sex s on s.code = p.sex
left outer join an_stat a on  a.an = o.an

where a.dchdate between $datestart and $dateend
and o.an  != ''  and c.clinic='019'  /* and c.clinic_member_status_id='1' */
and a.pdx between 'J450'  and 'J46'
group by o.hn
order by v.aid, v.moopart, v.hn, v.vstdate  ";

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => False,
        ]);

        
        return $this->render('report5', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    } // จบ function
    
     
       public function actionReport6($datestart, $dateend, $details) {
                                      // save log
        $this->SaveLog($this->dep_controller, 'report6', $this->getSession());

        $report_name = "รายงานจำนวนคนไข้คลินิกหอบหืด Re-visit ภายใน 48 ชั่วโมง ที่ OPD";

        $sql = "select
v.hn,v.vstdate,v.age_y,
concat(p.pname,p.fname,'  ',p.lname) as pt_name ,
v.pdx,v.dx0 ,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5,
 v.moopart,t.full_name as address

from vn_stat  v

left outer join clinicmember c on c.hn = v.hn
left outer join patient p on p.hn = v.hn
left outer join spclty s on s.spclty = v.spclty
left OUTER join thaiaddress t on t.addressid=v.aid
left outer join sex se on se.code = p.sex

where c.clinic = '019'  /* and c.clinic_member_status_id='1' */  and v.old_diagnosis = 'Y'
and v.lastvisit_hour <= 48
and v.vstdate between $datestart and $dateend
and  v.vn  not in (select e.vn from er_regist e )
and v.pdx between 'J450'  and 'J46'
group by v.hn
order by v.aid, v.moopart, v.hn, v.vstdate ";
        

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => False,
        ]);

        
        return $this->render('report6', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    } // จบ function
    
     
    
    
       public function actionReport7($datestart, $dateend, $details) {
                                                 // save log
        $this->SaveLog($this->dep_controller, 'report7', $this->getSession());


        $report_name = "รายงานจำนวนคนไข้คลินิกหอบหืด Re-visit ภายใน 48 ชั่วโมง ที่ ER";

        $sql = "select  v.hn,v.vstdate,
                concat(p.pname,p.fname,'  ',p.lname) as pt_name,v.age_y, s.name,
                v.pdx,v.dx0 ,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5,
                v.moopart,t.full_name as address


from vn_stat  v


left outer join clinicmember c on c.hn = v.hn
left outer join patient p on p.hn = v.hn
left outer join spclty s on s.spclty = v.spclty
right outer join  er_regist e on e.vn = v.vn
left OUTER join thaiaddress t on t.addressid=v.aid
left outer join sex se on se.code = p.sex

where c.clinic = '019'  /*and c.clinic_member_status_id='1'*/  
and v.lastvisit_hour <= 48 and v.old_diagnosis = 'Y'
and v.vstdate between $datestart and $dateend
and v.pdx between 'J450'  and 'J46'

group by v.hn
order by v.aid, v.moopart, v.hn, v.vstdate  ";
        

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => False,
        ]);

        
        return $this->render('report7', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    } // จบ function
    

    
    
    
       public function actionReport8($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report8', $this->getSession());


        $report_name = "รายงานจำนวนคนไข้คลินิกหอบหืด Re-admit ภายใน 28 วัน";
               
        $sql = "select o.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name,se.name,v.age_y,
            o.vstdate ,a.pdx  , a.old_diagnosis,
            v.moopart,t.full_name as address

from ovst  o
left outer join clinicmember c on c.hn = o.hn
left outer join patient p on p.hn = o.hn
left outer join vn_stat v on v.vn = o.vn
left outer join an_stat a on a.an  = o.an
left outer join thaiaddress t on t.addressid=v.aid
left outer join sex se on se.code = p.sex

where o.vstdate between $datestart and $dateend
and o.an  != ''  and c.clinic='019' /* and c.clinic_member_status_id='1' */
and a.old_diagnosis = 'Y'
and a.pdx between 'J450'  and 'J46'
and a.lastvisit<=28

group by o.hn ";
        

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => False,
        ]);

        
        return $this->render('report8', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    } // จบ function
    
    
    
}

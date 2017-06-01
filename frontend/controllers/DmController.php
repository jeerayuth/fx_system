<?php

namespace frontend\controllers;

use Yii;
use frontend\components\CommonController;

class DmController extends CommonController {
    public $dep_controller = 'dm';

    public function actionReport1($uclinic) {
        $this->SaveLog($this->dep_controller, 'report1', $this->getSession());

        if ($uclinic != "") { // เริ่มต้นตรวจสอบประเภทคนไข้ในคลินิก
            // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
            // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานสรุปคนไข้ทะเบียนเบาหวานที่ไม่มีความดันโลหิตร่วมด้วยแยกตามที่อยู่ในแต่ละสถานบริการ(คน)';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานสรุปคนไข้ทะเบียนเบาหวานที่มีความดันโลหิตร่วมด้วยแยกตามที่อยู่ในแต่ละสถานบริการ(คน)';
            }

            $sql = " SELECT
'1' as hosp_area,'รพ.สต.ตำบลทุ่งหลวง' as hosp_name , th.full_name as address,count(distinct(cm.hn)) as count_hn
FROM clinicmember  cm
LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
WHERE 
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

AND 
    cm.hn  $get_type  in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))

AND pd.code in('3','03')
AND concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860502'   and pt.moopart in (1,2,3,4,5,6,7,8,9)

GROUP BY th.addressid 


union


SELECT
'2' as hosp_area,'รพ.สต.ตำบลสวนแตง' as hosp_name , th.full_name as address,count(distinct(cm.hn)) as count_hn
FROM clinicmember  cm
LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
WHERE 
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND 
    cm.hn  $get_type  in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))

AND pd.code in('3','03')
AND concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860503'   and pt.moopart in (2,3,4,5,6,9)

GROUP BY th.addressid



union


SELECT
'3' as hosp_area,'รพ.สต.ตำบลทุ่งคาวัด' as hosp_name , th.full_name as address,count(distinct(cm.hn)) as count_hn
FROM clinicmember  cm
LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
WHERE 
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND 
    cm.hn  $get_type  in (select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))

AND pd.code in('3','03')
AND concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860504'   and pt.moopart in (1,2,3,4,6)

GROUP BY th.addressid


union


SELECT
'4' as hosp_area,'รพ.สต.บ้านคลองสง' as hosp_name , th.full_name as address,count(distinct(cm.hn)) as count_hn
FROM clinicmember  cm
LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
WHERE 
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND 
    cm.hn  $get_type  in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))

AND pd.code in('3','03')
AND concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860501'   and pt.moopart in (8,11,13,15,17,18,20)

GROUP BY th.addressid


union


SELECT
'5' as hosp_area,'รพ.สต.บ้านทับใหม่' as hosp_name , th.full_name as address,count(distinct(cm.hn)) as count_hn
FROM clinicmember  cm
LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
WHERE 
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND 
    cm.hn  $get_type  in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))

AND pd.code in ('3','03')

AND (concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860501' and pt.moopart in (16,19)
OR concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860504' and pt.moopart in (5,7,8))
GROUP BY  hosp_area



union


SELECT
'6' as hosp_area,'รพ.สต.บ้านควรผาสุก' as hosp_name , th.full_name as address,count(distinct(cm.hn)) as count_hn
FROM clinicmember  cm
LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
WHERE 
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND 
    cm.hn  $get_type  in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))

AND pd.code in('3','03')
AND concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860503'   and pt.moopart in (1,7,8,10)

GROUP BY th.addressid



union


SELECT
'7' as hosp_area,'รพ.ละแม' as hosp_name , th.full_name as address,count(distinct(cm.hn)) as count_hn
FROM clinicmember  cm
LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
WHERE 
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND 
    cm.hn  $get_type  in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))

AND pd.code in('3','03')
AND concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860501'   and pt.moopart in (1,2,3,4,5,6,7,9,10,12,14)
GROUP BY th.addressid

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
                        'rawData' => $rawData,
                        'uclinic' => $uclinic,
                        'report_name' => $report_name,
            ]);
        } else {  // จบตรวจสอบการเลือกประเภทคนไข้ในคลินิก
            echo "กรุณาเลือกประเภทคนไข้ในคลินิกด้วยครับ";
        }
    }

    /* รายงานสรุปทะเบียนเบาหวานแบบ(แสดงรายชื่อคนไข้) */

    public function actionReport2($hosp_area, $uclinic) {
        $this->SaveLog($this->dep_controller, 'report2', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        $get_type = "";
        $report_name = "";
        $hosp_area_condition = "";
        
        if ($uclinic != "" && $hosp_area != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานคนไข้ทะเบียนเบาหวานที่ไม่มีความดันโลหิตร่วมด้วย';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานคนไข้ทะเบียนเบาหวานที่มีความดันโลหิตร่วมด้วย';
            }
            
            if($hosp_area == 1) {
                $hosp_area_condition = " AND concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860502'   and pt.moopart in (1,2,3,4,5,6,7,8,9) ";
            } else if ($hosp_area == 2) {
                $hosp_area_condition = " AND concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860503'   and pt.moopart in (2,3,4,5,6,9)";
            } else if ($hosp_area == 3) {
                $hosp_area_condition = " AND concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860504'   and pt.moopart in (1,2,3,4,6) "; 
            } else if ($hosp_area == 4) {
                $hosp_area_condition = " AND concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860501'   and pt.moopart in (8,11,13,15,17,18,20) ";
            } else if ($hosp_area == 5) {
               $hosp_area_condition = " AND (concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860501'    and pt.moopart in (16,19)
                                        OR concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860504'     and pt.moopart in (5,7,8)) ";
            } else if ($hosp_area == 6) {
                $hosp_area_condition = " AND concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860503'   and pt.moopart in (1,7,8,10) ";
            } else if ($hosp_area == 7) {
                $hosp_area_condition = " AND concat(pt.chwpart,pt.amppart,pt.tmbpart) =  '860501'   and pt.moopart in (1,2,3,4,5,6,7,9,10,12,14) ";
            }
            
            
           
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
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND 
    cm.hn $get_type in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))

AND pd.code in('3','03')

$hosp_area_condition
    
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
        }// จบตรวจสอบการเลือกประเภทคนไข้ในคลินิก
    }

    public function actionReport3($uclinic, $datestart, $dateend, $details) {
        $this->SaveLog($this->dep_controller, 'report3', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่ไม่มีความดันโลหิตร่วมได้รับการคัดกรองการสูบบุหรี่/ดื่มสุรา ';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่มีความดันร่วมได้รับการคัดกรองการสูบบุหรี่/ดื่มสุรา';
            }

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
        cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
and
    	cm.hn  $get_type  in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
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
        }// จบ function
    }

    public function actionReport4($uclinic, $datestart, $dateend, $details) {
        $this->SaveLog($this->dep_controller, 'report4', $this->getSession());
        
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่ไม่มีความดันโลหิตร่วมได้รับการคัดกรองภาวะโรคซึมเศร้า';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่มีความดันร่วมได้รับการคัดกรองภาวะโรคซึมเศร้า';
            }

            $sql = "select v.hn, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,v.age_y as age_y, o.bmi,
                s.name as sex,
                v.moopart,t.full_name as address, v.vstdate

from vn_stat v

left outer join opdscreen o on o.vn = v.vn
left outer join depression_screen d on d.vn = v.vn
left outer join patient pt on pt.hn = v.hn
left outer join clinicmember cm on cm.hn = v.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code=cs.provis_typedis
left OUTER join thaiaddress t on t.addressid=v.aid
left outer join sex s on s.code = pt.sex

where

  v.vstdate between $datestart and $dateend
and
  d.depression_screen_id !=0
and 
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))       
and
  cm.hn  $get_type   in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))

group by v.hn
order by v.aid, v.moopart, v.hn, v.vstdate";

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
        }
    }

// จบ function



    public function actionReport5($uclinic, $datestart, $dateend, $details) {
        $this->SaveLog($this->dep_controller, 'report5', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่ไม่มีความดันโลหิตร่วมได้รับการตรวจตา';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่มีความดันร่วมได้รับการตรวจตา';
            }

            $sql = "
SELECT

cc.hn, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name, v.age_y as age_y,
v.moopart,t.full_name as address,
cc.screen_date as vstdate,
ds.dmht_eye_screen_result_name as left_eye ,ds2.dmht_eye_screen_result_name as right_eye  

FROM clinicmember_cormobidity_screen cc

left outer join clinicmember    cm  on cm.clinicmember_id =  cc.clinicmember_id
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code=cs.provis_typedis
left outer join clinicmember_cormobidity_eye_screen   ce on ce.clinicmember_cormobidity_screen_id = cc.clinicmember_cormobidity_screen_id
left outer join dmht_eye_screen_result ds on ds.dmht_eye_screen_result_id = ce.dmht_eye_screen_result_left_id
left outer join dmht_eye_screen_result ds2 on ds2.dmht_eye_screen_result_id = ce.dmht_eye_screen_result_right_id
left outer join patient pt on pt.hn = cc.hn
left outer join sex s on s.code = pt.sex
left outer join vn_stat v on v.vn = cc.vn
left OUTER join thaiaddress t on t.addressid=v.aid

WHERE 
    cc.screen_date between $datestart and $dateend
and
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
and
    cm.hn  $get_type   in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
    
and (cc.do_eye_screen='Y') 
group by cc.hn
order by v.aid, v.moopart, v.hn, cc.screen_date

";

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
        }
    }

// จบ function


    public function actionReport6($uclinic, $datestart, $dateend, $details) {
        $this->SaveLog($this->dep_controller, 'report6', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่ไม่มีความดันโลหิตร่วมได้รับการตรวจเท้า';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่มีความดันร่วมได้รับการตรวจเท้า';
            }

            $sql = "
SELECT

cc.hn, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name, v.age_y as age_y,
v.moopart,t.full_name as address,
cc.screen_date as vstdate,
df.dmht_foot_screen_result_name as left_foot,df2.dmht_foot_screen_result_name as right_foot

FROM clinicmember_cormobidity_screen cc

left outer join clinicmember    cm  on cm.clinicmember_id =  cc.clinicmember_id
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code=cs.provis_typedis
left outer join clinicmember_cormobidity_foot_screen  cf on cf.clinicmember_cormobidity_screen_id = cc.clinicmember_cormobidity_screen_id
left outer join dmht_foot_screen_result df on df.dmht_foot_screen_result_id = cf.dmht_foot_screen_result_left_id
left outer join dmht_foot_screen_result df2 on df2.dmht_foot_screen_result_id = cf.dmht_foot_screen_result_right_id
left outer join patient pt on pt.hn = cc.hn
left outer join sex s on s.code = pt.sex
left outer join vn_stat v on v.vn = cc.vn
left OUTER join thaiaddress t on t.addressid=v.aid

WHERE 
    cc.screen_date between $datestart and $dateend
and
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
and
    cm.hn  $get_type   in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
    
and (cc.do_foot_screen='Y') 
group by cc.hn
order by v.aid, v.moopart, v.hn, cc.screen_date

";

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
        }
    }

// จบ function
    public function actionReport7($uclinic, $datestart, $dateend, $details, $operators = null, $result_first = null, $lab_items = null, $drug_items) {
        $this->SaveLog($this->dep_controller, 'report7', $this->getSession());
        
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        $logics = "";
        $get_labs = "";
        $get_drugs = "";
        $get_type = "";

        if ($drug_items != "") {
            if ($drug_items == 1) {
                $get_drugs = " in (1460151,1000122,1520009) ";
            } else if ($drug_items == 2) {
                $get_drugs = " in (1430101) ";
            } else if ($drug_items == 3) {
                $get_drugs = " in (1460402) ";
            } else if ($drug_items == 4) {
                $get_drugs = " in (1510034) ";
            }
        }

        if ($lab_items != "") {
            if ($lab_items == 1) {
                $get_labs = 48; // HbA1C
            } else if ($lab_items == 2) {
                $get_labs = 3248; // eGFR
            } else if ($lab_items == 3) {
                $get_labs = '3209,3038'; // Urine Protine      
            } else if ($lab_items == 4) {
                $get_labs = 3209; // Microalbumine      
            } else if ($lab_items == 5) {
                $get_labs = '2070,3005,3006,2071,3007,2072,3008'; // Lipid Profile      
            }else if ($lab_items == 6) {
                $get_labs = '3003'; // Creatinine      
            }
        }

        if ($uclinic != "") {
            if ($uclinic == 1) {
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่ไม่มีความดันโลหิตร่วมได้รับการตรวจแลป';
                $get_type = "  AND c.hn  not   in (
                    select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code' )) ";
            } else if ($uclinic == 2) {
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่มีความดันร่วมได้รับการตรวจแลป';
                $get_type = "  AND c.hn   in (
                    select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code')) ";
            } else if ($uclinic == 3) {
                $get_type = "";
                $report_name = 'รายงานจำนวนคนไข้ในคลินิคเบาหวานทั้งหมดได้รับการตรวจแลป';
            }

            if ($operators != "" && $result_first != "") {
                $logics = "  AND lo.lab_order_result $operators  $result_first  ";
            }

            $sql = "            
SELECT
o.hn,concat(p.pname, p.fname,' ',p.lname) as pt_name,v.age_y,
v.moopart,t.full_name as address,o.vstdate,lo.lab_order_result,

(
    SELECT CASE 
      WHEN (lo.lab_order_result >=90) THEN '1'
      WHEN (lo.lab_order_result >=60 AND lo.lab_order_result <=89.99) THEN '2'
      WHEN (lo.lab_order_result >=30 AND lo.lab_order_result <=59.99) THEN '3A'
      WHEN (lo.lab_order_result >=15 AND lo.lab_order_result <=29.99) THEN '4'
      ELSE '5' END
      
) AS lab_order_result_report ";

            if ($drug_items != "") {

                $sql .= ", if((select  
                             concat(op.vstdate,' => ',d.name)               
                             from opitemrece op 
                             left outer join drugitems d on d.icode = op.icode
                             where op.hn = o.hn 
                             and op.icode $get_drugs
                             and op.vstdate between  $datestart and $dateend 
                             limit 1 ) is not null, (select  
                             concat(max(op.vstdate),' => ',d.name)               
                             from opitemrece op 
                             left outer join drugitems d on d.icode = op.icode
                             where op.hn = o.hn 
                             and op.icode $get_drugs
                             and op.vstdate between  $datestart and $dateend 
                             limit 1 ) ,' ') as drug ";
            }


            $sql.= " FROM ovst o

left outer join clinicmember c ON c.hn=o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id = c.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left outer join vn_stat v      ON v.vn = o.vn
left outer join thaiaddress t  on t.addressid = v.aid
left outer join patient p      ON p.hn = o.hn
left outer join lab_head lh    ON lh.vn = v.vn
left outer join lab_order lo   ON lo.lab_order_number = lh.lab_order_number
left outer join lab_items li   ON li.lab_items_code = lo.lab_items_code

WHERE lo.lab_items_code in ($get_labs) AND lo.confirm = 'Y'

AND o.vstdate BETWEEN   $datestart and $dateend 
AND c.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
   
$get_type
    
AND lo.lab_order_result!=''
AND lo.lab_order_result!='-' 
AND lo.lab_order_result!='.'

$logics
    
GROUP  BY o.hn
ORDER  BY v.aid, v.moopart, v.hn, v.vstdate ";


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
                        'lab_item' => $get_labs,
                        'operators' => $operators,
                        'result_first' => $result_first,
                        'uclinic' => $uclinic,
                        'datestart' => $datestart,
                        'dateend' => $dateend,
                        'drug_items' => $drug_items,
            ]);
        }
    }

// จบ function


    public function actionReport8($uclinic, $datestart, $dateend, $details) {
        $this->SaveLog($this->dep_controller, 'report8', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่ไม่มีความดันโลหิตที่มี Diag Hypoglycemia และได้รับการ Admit';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่มีความดันร่วมที่มี Diag Hypoglycemia และได้รับการ Admit';
            }

            $sql = "select v.hn,o.an, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,v.age_y as age_y,
                s.name as sex,
                v.moopart,t.full_name as address, v.vstdate

from ovst  o

left outer join vn_stat v on v.vn = o.vn
left outer join patient pt on pt.hn = o.hn
left outer join clinicmember cm on cm.hn = o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left OUTER join thaiaddress t on t.addressid= v.aid
left outer join sex s on s.code = pt.sex

where

  o.vstdate between $datestart and $dateend

and
  o.an!=''
and 
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))     
and
  cm.hn  $get_type   in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
  
AND

(v.pdx = 'E162' OR v.dx0 = 'E162' OR v.dx1='E162' OR v.dx2='E162' OR v.dx3='E162' OR v.dx4='E162' OR v.dx5='E162') 

ORDER BY v.aid, v.moopart, v.hn, v.vstdate";

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
        }
    }

// จบ function

    public function actionReport9($uclinic, $datestart, $dateend, $details) {
        $this->SaveLog($this->dep_controller, 'report9', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนครั้งคนไข้คลินิคเบาหวานที่ไม่มีความดันโลหิตที่มี Diag Hyperglycemia และได้รับการ Admit';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนครั้งคนไข้คลินิคเบาหวานที่มีความดันร่วมที่มี Diag Hyperglycemia และได้รับการ Admit';
            }

            $sql = "select v.hn,o.an, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,v.age_y as age_y,
                s.name as sex,
                v.moopart,t.full_name as address, v.vstdate

from ovst  o

left outer join vn_stat v on v.vn = o.vn
left outer join patient pt on pt.hn = o.hn
left outer join clinicmember cm on cm.hn = o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left OUTER join thaiaddress t on t.addressid= v.aid
left outer join sex s on s.code = pt.sex

where
  o.vstdate between $datestart and $dateend

and
  o.an!=''
and  
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))     
and
  cm.hn  $get_type in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
  
AND

(v.pdx = 'R739' OR v.dx0 = 'R739' OR v.dx1='R739' OR v.dx2='R739' OR v.dx3='R739' OR v.dx4='R739' OR v.dx5='R739')

ORDER BY v.aid, v.moopart, v.hn, v.vstdate";

            try {
                $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }

            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => False,
            ]);

            return $this->render('report9', [
                        'dataProvider' => $dataProvider,
                        'report_name' => $report_name,
                        'details' => $details,
            ]);
        }
    }

// จบ function


    public function actionReport10($uclinic, $datestart, $dateend, $details) {
        $this->SaveLog($this->dep_controller, 'report10', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่ไม่มีความดันโลหิต CKD Diag (N181 - N185)';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่มีความดันร่วม CKD Diag (N181 - N185)';
            }

            $sql = "select v.hn,o.an, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,v.age_y as age_y,
                s.name as sex,
                v.moopart,t.full_name as address, v.vstdate,
                v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5 ,
                
                (
                      select  count(distinct(lh.vn))
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                )  as count_lab_gfr ,


                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                )!= '',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                ), '') as lab_gfr_last ,
                             

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 1,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 1,1
                ), '')  as lab_gfr_second_last

                 ,

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 2,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 2,1
                ), '')  as lab_gfr_third_last  ,

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 3,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 3,1
                ), '')  as lab_gfr_fourth_last

from ovst  o

left outer join vn_stat v on v.vn = o.vn
left outer join patient pt on pt.hn = o.hn
left outer join clinicmember cm on cm.hn = o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left OUTER join thaiaddress t on t.addressid= v.aid
left outer join sex s on s.code = pt.sex

WHERE
  o.vstdate between $datestart and $dateend
AND 
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND
  cm.hn  $get_type   in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
(
          (v.dx0 = 'N181') OR
          (v.dx1 = 'N181') OR
          (v.dx2 = 'N181') OR
          (v.dx3 = 'N181') OR
          (v.dx4 = 'N181') OR
          (v.dx5 = 'N181')
 )
 
GROUP BY v.hn

UNION

select v.hn,o.an, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,v.age_y as age_y,
                s.name as sex,
                v.moopart,t.full_name as address, v.vstdate,
                v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5 ,
                

                (
                      select  count(distinct(lh.vn))
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                )  as count_lab_gfr ,


                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                ), '') as lab_gfr_last ,
                
                    

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 1,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 1,1
                ), '')  as lab_gfr_second_last

                 ,

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 2,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 2,1
                ), '')  as lab_gfr_third_last  ,

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 3,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 3,1
                ), '')  as lab_gfr_fourth_last

from ovst  o

left outer join vn_stat v on v.vn = o.vn
left outer join patient pt on pt.hn = o.hn
left outer join clinicmember cm on cm.hn = o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left OUTER join thaiaddress t on t.addressid= v.aid
left outer join sex s on s.code = pt.sex

WHERE
  o.vstdate between $datestart and $dateend
AND 
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND
  cm.hn  $get_type   in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
(
          (v.dx0 = 'N182') OR
          (v.dx1 = 'N182') OR
          (v.dx2 = 'N182') OR
          (v.dx3 = 'N182') OR
          (v.dx4 = 'N182') OR
          (v.dx5 = 'N182')
 )
 
GROUP BY v.hn

UNION

select v.hn,o.an, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,v.age_y as age_y,
                s.name as sex,
                v.moopart,t.full_name as address, v.vstdate,
                v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5 ,
                
                (
                      select  count(distinct(lh.vn))
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                )  as count_lab_gfr ,


                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                ), '') as lab_gfr_last ,
                
                    

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 1,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 1,1
                ), '')  as lab_gfr_second_last

                 ,

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 2,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 2,1
                ), '')  as lab_gfr_third_last  ,

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 3,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 3,1
                ), '')  as lab_gfr_fourth_last

from ovst  o

left outer join vn_stat v on v.vn = o.vn
left outer join patient pt on pt.hn = o.hn
left outer join clinicmember cm on cm.hn = o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left OUTER join thaiaddress t on t.addressid= v.aid
left outer join sex s on s.code = pt.sex

WHERE
  o.vstdate between $datestart and $dateend
AND 
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND
  cm.hn  $get_type   in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
(
          (v.dx0 = 'N183') OR
          (v.dx1 = 'N183') OR
          (v.dx2 = 'N183') OR
          (v.dx3 = 'N183') OR
          (v.dx4 = 'N183') OR
          (v.dx5 = 'N183')
 )
 
GROUP BY v.hn


UNION

select v.hn,o.an, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,v.age_y as age_y,
                s.name as sex,
                v.moopart,t.full_name as address, v.vstdate,
                v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5 ,
                
                (
                      select  count(distinct(lh.vn))
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                )  as count_lab_gfr ,


                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                ), '') as lab_gfr_last ,
                
                    

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 1,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 1,1
                ), '')  as lab_gfr_second_last

                 ,

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 2,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 2,1
                ), '')  as lab_gfr_third_last  ,

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 3,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 3,1
                ), '')  as lab_gfr_fourth_last

from ovst  o

left outer join vn_stat v on v.vn = o.vn
left outer join patient pt on pt.hn = o.hn
left outer join clinicmember cm on cm.hn = o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left OUTER join thaiaddress t on t.addressid= v.aid
left outer join sex s on s.code = pt.sex

WHERE
  o.vstdate between $datestart and $dateend
AND 
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND
  cm.hn  $get_type   in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
(
          (v.dx0 = 'N184') OR
          (v.dx1 = 'N184') OR
          (v.dx2 = 'N184') OR
          (v.dx3 = 'N184') OR
          (v.dx4 = 'N184') OR
          (v.dx5 = 'N184')
 )
 
GROUP BY v.hn

UNION

select v.hn,o.an, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,v.age_y as age_y,
                s.name as sex,
                v.moopart,t.full_name as address, v.vstdate,
                v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5  ,
                
                (
                      select  count(distinct(lh.vn))
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                )  as count_lab_gfr ,


                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 0,1
                ), '') as lab_gfr_last ,
                
                    

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 1,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 1,1
                ), '')  as lab_gfr_second_last

                 ,

                if((
                      select lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 2,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 2,1
                ), '')  as lab_gfr_third_last  ,

                if((
                      select  lh.vn
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 3,1
                )!='',(
                      select  concat(concat(DAY(lh.report_date),'/',MONTH(lh.report_date),'/',(YEAR(lh.report_date)+543)),' => ',lo.lab_order_result)
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.hn = o.hn and lo.lab_items_code = 3248
                      and lh.report_date between $datestart and $dateend
                      order by lh.report_date desc limit 3,1
                ), '')  as lab_gfr_fourth_last

from ovst  o

left outer join vn_stat v on v.vn = o.vn
left outer join patient pt on pt.hn = o.hn
left outer join clinicmember cm on cm.hn = o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left OUTER join thaiaddress t on t.addressid= v.aid
left outer join sex s on s.code = pt.sex

WHERE
  o.vstdate between $datestart and $dateend
AND 
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND
  cm.hn  $get_type   in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
(
          (v.dx0 = 'N185') OR
          (v.dx1 = 'N185') OR
          (v.dx2 = 'N185') OR
          (v.dx3 = 'N185') OR
          (v.dx4 = 'N185') OR
          (v.dx5 = 'N185')
 )
 
GROUP BY v.hn ";




            try {
                $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }

            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => False,
            ]);

            return $this->render('report10', [
                        'dataProvider' => $dataProvider,
                        'report_name' => $report_name,
                        'details' => $details,
                        'uclinic' => $uclinic,
                        'datestart' => $datestart,
                        'dateend' => $dateend,
            ]);
        }
    }

// จบ function

    public function actionReport11($uclinic, $details) {
         $this->SaveLog($this->dep_controller, 'report11', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานคนไข้ทะเบียนเบาหวานที่ไม่มีความดันโลหิตร่วมด้วย + โรคหัวใจ';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานคนไข้ทะเบียนเบาหวานที่มีความดันโลหิตร่วมด้วย  + โรคหัวใจ';
            }

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
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND 
    cm.hn $get_type in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
    cm.hn IN
       (
            select cl.hn from clinicmember cl  where cl.hn = cm.hn and cl.clinic = '015' 
       )

AND pd.code in('3','03')
GROUP BY pt.hn     
ORDER BY pt.moopart,age_y ";


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
        }  // จบตรวจสอบการเลือกประเภทคนไข้ในคลินิก
    }

    public function actionReport12($uclinic, $details) {
         $this->SaveLog($this->dep_controller, 'report12', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานคนไข้ทะเบียนเบาหวานที่ไม่มีความดันโลหิตร่วมด้วย + หลอดเลือดสมอง';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานคนไข้ทะเบียนเบาหวานที่มีความดันโลหิตร่วมด้วย  + หลอดเลือดสมอง';
            }

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
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND 
    cm.hn $get_type in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
    cm.hn IN
       (
            select cl.hn from clinicmember cl  where cl.hn = cm.hn and cl.clinic = '014' 
       )

AND pd.code in('3','03')
GROUP BY pt.hn     
ORDER BY pt.moopart,age_y ";


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
            ]);
        }  // จบตรวจสอบการเลือกประเภทคนไข้ในคลินิก
    }

    public function actionReport13($uclinic, $datestart, $dateend, $details) {
         $this->SaveLog($this->dep_controller, 'report13', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานคนไข้ทะเบียนเบาหวานรายใหม่(ตามวันที่ลงทะเบียน)ที่ไม่มีความดันโลหิตร่วมด้วย';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานคนไข้ทะเบียนเบาหวานรายใหม่(ตามวันที่ลงทะเบียน)ที่มีความดันโลหิตร่วมด้วย';
            }

            $sql = "         
SELECT
pt.hn as hn,concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
concat( timestampdiff(year,pt.birthday,now()), ' ปี') as age_y,
pt.cid,
(
   select cr.regdate from clinicmember cr where cr.hn = cm.hn and cr.clinic = 
            (select sys_value from sys_var where sys_name='dm_clinic_code')  group by cr.hn
) as regdate,

(
   select cr.begin_year from clinicmember cr where cr.hn = cm.hn and cr.clinic = 
            (select sys_value from sys_var where sys_name='dm_clinic_code')  group by cr.hn
) as begin_year,

concat(pt.addrpart,' ม.',pt.moopart,' ',th.full_name) address,
pt.moopart
FROM clinicmember  cm
LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)

WHERE 
    cm.hn in(
                select hn from clinicmember 
                    where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code') 
                    and regdate between $datestart and $dateend      
            )
AND 
    cm.hn  $get_type  in (select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))

AND pd.code in('3','03')

GROUP BY pt.hn 
ORDER BY pt.moopart,age_y ";


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
            ]);
        }// จบตรวจสอบการเลือกประเภทคนไข้ในคลินิก
    }

    public function actionReport14($uclinic, $datestart, $dateend, $details) {
         $this->SaveLog($this->dep_controller, 'report14', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงาน CVD-RISK คนไข้เบาหวานที่ไม่มีความดันโลหิตร่วมด้วย';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงาน CVD-RISK คนไข้เบาหวานที่มีความดันโลหิตร่วมด้วย';
            }

            $sql = "         

select pn.hn, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,date(pn.note_datetime) as note_date,  pn.note_staff ,cl.other_chronic_text ,pn.plain_text ,
pt.moopart,t.full_name as address

 from ptnote  pn

 left outer join patient pt on pt.hn = pn.hn
 left outer join clinicmember cl  on cl.hn = pn.hn
 left outer join thaiaddress t on t.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)

 where pn.plain_text like 'cvd%'

 AND cl.hn in (select hn from clinicmember where clinic =(select sys_value from sys_var where sys_name='dm_clinic_code'))

 AND cl.hn $get_type in (select hn from clinicmember where clinic =(select sys_value from sys_var where sys_name='ht_clinic_code'))

 and note_datetime between $datestart and $dateend 

 group by pn.hn

 order by pn.plain_text  ,pt.tmbpart ,pt.moopart ";


            $sql2 = "         

select pn.plain_text , count(distinct(pn.hn)) as count_hn

 from ptnote  pn

 left outer join patient pt on pt.hn = pn.hn
 left outer join clinicmember cl  on cl.hn = pn.hn
 left outer join thaiaddress t on t.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)

 where pn.plain_text like 'cvd%'

 AND cl.hn in (select hn from clinicmember where clinic =(select sys_value from sys_var where sys_name='dm_clinic_code'))

 AND cl.hn $get_type in (select hn from clinicmember where clinic =(select sys_value from sys_var where sys_name='ht_clinic_code'))

 and note_datetime between $datestart and $dateend 

 group by pn.plain_text

 order by pn.plain_text ";


            try {
                $rawData = \yii::$app->db->createCommand($sql)->queryAll();
                $rawData2 = \yii::$app->db->createCommand($sql2)->queryAll();
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



            return $this->render('report14', [
                        'dataProvider' => $dataProvider,
                        'dataProvider2' => $dataProvider2,
                        'rawData2' => $rawData2,
                        'report_name' => $report_name,
                        'details' => $details,
            ]);
        }  // จบตรวจสอบการเลือกประเภทคนไข้ในคลินิก
    }
    
    
    
    public function actionReport15($uclinic, $datestart, $dateend, $details) {
         $this->SaveLog($this->dep_controller, 'report15', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่ไม่มีความดันโลหิตร่วม ตรวจสอบ BP >= 180';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่มีความดันร่วม ตรวจสอบ BP >= 180';
            }
            
            
            $sql = "SELECT
                        o.hn,concat(p.pname, p.fname,' ',p.lname) as pt_name,v.age_y,
                        v.moopart,t.full_name as address,

                        (
                                  select count(op.vn) from opdscreen op  where op.hn = o.hn    and 
                                  op.vstdate between  $datestart and $dateend   and op.bps >= 180

                        ) as count_bps_180_up

                    FROM ovst o
                        left outer join clinicmember cm ON cm.hn=o.hn
                        left outer join clinic_member_status cs on cs.clinic_member_status_id = cm.clinic_member_status_id
                        left outer join provis_typedis pd on pd.code = cs.provis_typedis
                        left outer join vn_stat v      ON v.vn = o.vn
                        left outer join thaiaddress t  on t.addressid = v.aid
                        left outer join patient p      ON p.hn = o.hn

                    WHERE
                         o.vstdate BETWEEN   $datestart and $dateend
                        AND cm.hn in (select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
                        AND cm.hn $get_type in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
                    GROUP  BY o.hn
                    ORDER  BY count_bps_180_up DESC ";

            try {
                $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }

            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => False,
            ]);

            return $this->render('report15', [
                        'dataProvider' => $dataProvider,
                        'report_name' => $report_name,
                        'details' => $details,
            ]);
        }
    }
    
    
     public function actionReport16($uclinic, $datestart, $dateend, $details) {
          $this->SaveLog($this->dep_controller, 'report16', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่ไม่มีความดันโลหิตร่วม ประวัติคัดกรอง BP';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่มีความดันร่วม ประวัติคัดกรอง BP';
            }
                       
            $sql = "SELECT
                        cm.clinic,cm.hn,
                        concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
                        pt.addrpart,
                        pt.moopart,
                        t.full_name as addresspart,
                        concat(DAY(ops.vstdate),'/',MONTH(ops.vstdate),'/',(YEAR(ops.vstdate)+543)) as screen_date,
                        vns.pdx,
                        ops.bps as bps_last,
                        ops.bpd as bpd_last
             
                  FROM clinicmember  cm
                  LEFT OUTER JOIN clinic_member_status cs ON cs.clinic_member_status_id=cm.clinic_member_status_id
                  LEFT OUTER JOIN provis_typedis pd ON pd.code=cs.provis_typedis
                  LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
                  LEFT OUTER JOIN thaiaddress t  ON t.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
                  LEFT OUTER JOIN (
                        SELECT    hn,max(vn) as vn
                        FROM      vn_stat
                        WHERE     vstdate BETWEEN $datestart and $dateend AND vn in
                                  (
                                       select vn from opdscreen
                                       where bps != '' and bpd != ''
                                   )
                                    GROUP BY  hn
                        ) oc ON (oc.hn = cm.hn)
                  LEFT OUTER JOIN vn_stat vns ON vns.vn = oc.vn
                  LEFT OUTER JOIN opdscreen ops ON ops.vn = oc.vn
          
                  WHERE 
                      cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
                  AND 
                      cm.hn  $get_type in (select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
                  AND pd.code  = '03'

                  GROUP BY cm.hn ORDER BY t.addressid ";

            try {
                $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }

            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => False,
            ]);

            return $this->render('report16', [
                        'dataProvider' => $dataProvider,
                        'report_name' => $report_name,
                        'details' => $details,
            ]);
        }
    }
    
    
     public function actionReport17($uclinic, $datestart, $dateend, $details) {
          $this->SaveLog($this->dep_controller, 'report17', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่ไม่มีความดันโลหิตร่วม ประวัติตรวจแลป FBS,DTX > 180 ขึ้นไป';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่มีความดันร่วม  ประวัติตรวจแลป FBS,DTX > 180 ขึ้นไป';
            }
                       
            $sql = "SELECT
                        o.hn,o.vn,concat(p.pname, p.fname,' ',p.lname) as pt_name,v.age_y,
                        concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,
                        v.moopart,t.full_name as address,o.vstdate,v.pdx,li.lab_items_name,lo.lab_order_result

                        FROM ovst o
                            left outer join clinicmember c ON c.hn=o.hn
                            left outer join clinic_member_status cs on cs.clinic_member_status_id = c.clinic_member_status_id
                            left outer join provis_typedis pd on pd.code = cs.provis_typedis
                            left outer join vn_stat v      ON v.vn = o.vn
                            left outer join thaiaddress t  on t.addressid = v.aid
                            left outer join patient p      ON p.hn = o.hn
                            left outer join lab_head lh    ON lh.vn = v.vn
                            left outer join lab_order lo   ON lo.lab_order_number = lh.lab_order_number
                            left outer join lab_items li   ON li.lab_items_code = lo.lab_items_code
                        WHERE lo.lab_items_code in ('3246','3001') AND lo.confirm = 'Y'

                        AND o.vstdate BETWEEN  $datestart and $dateend                      
                        AND c.hn in (select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
                        AND c.hn $get_type in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
                        AND lo.lab_order_result!=''
                        AND lo.lab_order_result!='-' 
                        AND lo.lab_order_result!='.'
                        AND lo.lab_order_result >= 180
                        ORDER  BY v.hn, v.vstdate ";

            try {
                $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }

            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => False,
            ]);

            return $this->render('report17', [
                        'dataProvider' => $dataProvider,
                        'report_name' => $report_name,
                        'details' => $details,
            ]);
        }
    }
    
    
     public function actionReport18($uclinic, $datestart, $dateend, $details) {
          $this->SaveLog($this->dep_controller, 'report18', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่ได้รับการ admit';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานที่มีความดันร่วมที่ได้รับการ admit';
            }
                       
            $sql = "select o.vn,concat(DAY(o.vstdate),'/',MONTH(o.vstdate),'/',(YEAR(o.vstdate)+543)) as vst_date,
            o.hn,o.an,concat(p.pname,p.fname,'  ',p.lname) as pt_name,v.age_y,s.name as sex,
            v.age_y,s.name as sex,o.vstdate, v.moopart,t.full_name as address,
            v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5

            from ovst  o

            left outer join clinicmember c on c.hn = o.hn
            left outer join patient p on p.hn = o.hn
            left outer join vn_stat v on v.vn = o.vn
            left OUTER join thaiaddress t on t.addressid=v.aid
            left outer join sex s on s.code = p.sex
            left outer join an_stat a on  a.an = o.an

            where a.dchdate between $datestart and $dateend 

            and o.an  != '' and
            
                c.hn in (select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
            AND 
                c.hn $get_type in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
                    
            group by o.vn

            order by v.aid, v.moopart, v.hn, v.vstdate";

            try {
                $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }

            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => False,
            ]);

            return $this->render('report18', [
                        'dataProvider' => $dataProvider,
                        'report_name' => $report_name,
                        'details' => $details,
            ]);
        }
    }
    
    
    
     public function actionReport19($uclinic, $datestart, $dateend, $details) {
          $this->SaveLog($this->dep_controller, 'report19', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวาน(DM ONLY) คัดกรองรอบเอว/ส่วนสูง';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานและมีความดันร่วม(DM WITH HT) คัดกรองรอบเอว/ส่วนสูง';
            }
                       
            $sql = "SELECT
                        cm.clinic,cm.hn,
                        concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
                        (
                           select max(v.vstdate)
                           from vn_stat v where v.vstdate between $datestart and $dateend and v.hn = cm.hn
                           group by v.hn
                           limit 1
                        ) as max_vstdate,
                        (
                           select max(o.height) from opdscreen o where o.vstdate between $datestart and $dateend and o.hn = cm.hn
                           group by o.hn    
                           limit 1
                        ) as height_last,
                        (
                           select max(o.height) from opdscreen o where o.vstdate between $datestart and $dateend and o.hn = cm.hn
                           group by o.hn    
                           limit 1
                        ) / 2 as height_last_divide2,            
                        ops.waist as waist_last,
                                            
                    (
                        SELECT CASE 
                          WHEN (height_last_divide2 < ops.waist) THEN 'ปกติ'
                          WHEN (height_last_divide2 > ops.waist) THEN 'ไม่ปกติ'
                          WHEN (height_last_divide2 = ops.waist) THEN 'ปกติ'
                          ELSE ' ' END
                    ) AS screen_result_report 
             
                  FROM clinicmember  cm
                  LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
                  LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
                  LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
                  LEFT OUTER JOIN (
                        SELECT    hn,max(vn) as vn
                        FROM      vn_stat
                        WHERE     vstdate BETWEEN $datestart and $dateend AND vn in
                                  (
                                       select vn from opdscreen
                                       where waist != ''
                                   )
                                    GROUP BY  hn
                        ) oc ON (oc.hn = cm.hn)
                  LEFT OUTER JOIN opdscreen ops ON ops.vn = oc.vn
          
                  WHERE 
                      cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
                  AND 
                      cm.hn  $get_type in (select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
                  AND pd.code  = '03'
                  GROUP BY cm.hn ";

            try {
                $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }

            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => False,
            ]);
           
            return $this->render('report19', [
                        'dataProvider' => $dataProvider,
                        'report_name' => $report_name,
                        'details' => $details,
            ]);
        }
    }
    
    
    
    
    public function actionReport20($datestart, $dateend, $details) {
          $this->SaveLog($this->dep_controller, 'report20', $this->getSession());
        // ตัวแปร $get_type เอาไว้ตรวจสอบว่าเป็นคนไข้ dm หรือ dm with ht
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
           $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวาน ที่ได้รับการ admit';
                          
            $sql = "SELECT
                    ov.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
                    ov.vn,ov.an,
                    v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5,
                    v.vstdate as vstdate_vn_stat,ov.vstdate as vstdate_ovst,
                    a.regdate as admit_date,
                    (
                      select
                            k.department
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      left outer join kskdepartment k on k.depcode = lh.order_department
                      where lh.vn = ov.an  and lo.lab_items_code = '3246' and lo.confirm='Y'
                      order by lh.lab_order_number asc
                      limit 1
                    ) as order_date_dtx_department,
                    (
                      select
                            lh.order_date
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.vn = ov.an  and lo.lab_items_code = '3246' and lo.confirm='Y'
                      order by lh.lab_order_number asc
                      limit 1
                    ) as order_date_dtx,
                    (
                      select
                            lh.lab_order_number
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.vn = ov.an  and lo.lab_items_code = '3246' and lo.confirm='Y'
                      order by lh.lab_order_number asc
                      limit 1
                    ) as lab_order_dtx,

                    (
                      select
                            lo.lab_order_result
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.vn = ov.an  and lo.lab_items_code = '3246' and lo.confirm='Y'
                      order by lh.lab_order_number asc
                      limit 1
                    ) as dtx,

                     (
                      select
                            doc.name
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      left outer join doctor doc on doc.code = lh.doctor_code
                      where lh.vn = ov.an  and lo.lab_items_code = '3246' and lo.confirm='Y'
                      order by lh.lab_order_number asc
                      limit 1
                    ) as doctor_code_dtx ,

                    (
                      select
                            k.department
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      left outer join kskdepartment k on k.depcode = lh.order_department
                      where lh.vn = ov.an  and lo.lab_items_code = '3001' and lo.confirm='Y'
                      order by lh.lab_order_number asc
                      limit 1
                    ) as order_date_glucose_department,

                           (
                      select
                            lh.order_date
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.vn = ov.an  and lo.lab_items_code = '3001' and lo.confirm='Y'
                      order by lh.lab_order_number asc
                      limit 1
                    ) as order_date_glucose,

                       (
                      select
                            lo.lab_order_number
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.vn = ov.an  and lo.lab_items_code = '3001' and lo.confirm='Y'
                      order by lh.lab_order_number asc
                      limit 1
                    ) as lab_order_glucose ,

                    (
                      select
                            lo.lab_order_result
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      where lh.vn = ov.an  and lo.lab_items_code = '3001' and lo.confirm='Y'
                      order by lh.lab_order_number asc
                      limit 1
                    ) as glucose ,


                     (
                      select
                            doc.name
                      from lab_head lh
                      left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                      left outer join doctor doc on doc.code = lh.doctor_code
                      where lh.vn = ov.an  and lo.lab_items_code = '3001' and lo.confirm='Y'
                      order by lh.lab_order_number asc
                      limit 1
                    ) as doctor_code_glucose



              FROM ovst ov
              LEFT OUTER JOIN vn_stat v ON v.vn = ov.vn
              LEFT OUTER JOIN an_stat a ON a.an = ov.an
              LEFT OUTER JOIN patient p ON p.hn = ov.hn

              WHERE ov.vstdate BETWEEN $datestart AND $dateend  AND

              (
                    (v.pdx BETWEEN 'e110' AND  'e119') OR
                    (v.dx0 BETWEEN 'e110' AND  'e119') OR
                    (v.dx1 BETWEEN 'e110' AND  'e119') OR
                    (v.dx2 BETWEEN 'e110' AND  'e119') OR
                    (v.dx3 BETWEEN 'e110' AND  'e119') OR
                    (v.dx4 BETWEEN 'e110' AND  'e119') OR
                    (v.dx5 BETWEEN 'e110' AND  'e119')
              )

              AND
                     ov.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))       
              AND    ov.an != '' ";

            try {
                $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }

            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => False,
            ]);
           
            return $this->render('report20', [
                        'dataProvider' => $dataProvider,
                        'report_name' => $report_name,
                        'details' => $details,
            ]); 
        }
        
        
        
        
        
    public function actionReport21($uclinic,$datestart, $dateend, $details) {
          $this->SaveLog($this->dep_controller, 'report21', $this->getSession());

           if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวาน(DM Only) ผลตรวจแลป DTX,Glucose ล่าสุด ตามช่วงวันที่ที่เลือก';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานและมีความดันร่วม(DM WITH HT) ผลตรวจแลป DTX,Glucose ล่าสุด ตามช่วงวันที่ที่เลือก';
            }
                                   
            $sql = "SELECT
                        cm.clinic,cm.hn,
                        concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
                        cs.clinic_member_status_name,
                        (
                          select
                                k.department
                          from lab_head lh
                          left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                          left outer join kskdepartment k on k.depcode = lh.order_department
                          where lh.order_date between $datestart AND $dateend and lh.hn = cm.hn
                             AND lo.lab_items_code = '3246' AND lo.confirm='Y'
                                order by lh.order_date desc
                                limit 1
                        ) as max_dtx_department,
                        (
                             select lh.order_date from lab_head lh
                             LEFT OUTER JOIN lab_order lo ON lo.lab_order_number = lh.lab_order_number
                             where lh.order_date between $datestart AND $dateend and lh.hn = cm.hn
                             AND lo.lab_items_code = '3246' AND lo.confirm='Y'
                                order by lh.order_date desc
                                limit 1
                        ) as max_dtx_order_date,
                        (
                             select lo.lab_order_result from lab_head lh
                             LEFT OUTER JOIN lab_order lo ON lo.lab_order_number = lh.lab_order_number
                             where lh.order_date between $datestart AND $dateend and lh.hn = cm.hn
                             AND lo.lab_items_code = '3246' AND lo.confirm='Y'
                                order by lh.order_date desc
                                limit 1
                        ) as max_dtx_order_result  ,
                         (
                          select
                                k.department
                          from lab_head lh
                          left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                          left outer join kskdepartment k on k.depcode = lh.order_department
                          where lh.order_date between $datestart AND $dateend and lh.hn = cm.hn
                             AND lo.lab_items_code = '3001' AND lo.confirm='Y'
                                order by lh.order_date desc
                                limit 1
                        ) as max_glucose_department,
                        (
                             select lh.order_date from lab_head lh
                             LEFT OUTER JOIN lab_order lo ON lo.lab_order_number = lh.lab_order_number
                             where lh.order_date between $datestart AND $dateend and lh.hn = cm.hn
                             AND lo.lab_items_code = '3001' AND lo.confirm='Y'
                                order by lh.order_date desc
                                limit 1
                        ) as max_glucose_order_date,
                        (
                             select lo.lab_order_result from lab_head lh
                             LEFT OUTER JOIN lab_order lo ON lo.lab_order_number = lh.lab_order_number
                             where lh.order_date between $datestart AND $dateend and lh.hn = cm.hn
                             AND lo.lab_items_code = '3001'  AND lo.confirm='Y'
                                order by lh.order_date desc
                                limit 1
                        ) as max_glucose_order_result

                    FROM clinicmember cm
                    LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
                    LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id = cm.clinic_member_status_id
                    LEFT OUTER JOIN provis_typedis pd on pd.code = cs.provis_typedis
                    WHERE
                         cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
                         AND cm.hn  $get_type in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
                         AND pd.code = '03'
                    GROUP BY cm.hn ";

            try {
                $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }

            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => False,
            ]);
           
            return $this->render('report21', [
                        'dataProvider' => $dataProvider,
                        'report_name' => $report_name,
                        'details' => $details,
            ]); 
        }
    
    }
    
    
     public function actionReport22($uclinic,$datestart, $dateend, $details) {
          $this->SaveLog($this->dep_controller, 'report22', $this->getSession());

           if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวาน(DM Only) ผลตรวจแลป LDL น้อยกว่า 100 ครั้งล่าสุด ตามช่วงวันที่ที่เลือก';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานและมีความดันร่วม(DM WITH HT) ผลตรวจแลป LDL น้อยกว่า 100 ครั้งล่าสุด ตามช่วงวันที่ที่เลือก';
            }
                                   
            $sql = "SELECT
                        cm.clinic,cm.hn,
                        pt.addrpart,
                        pt.moopart,
                        t.full_name as addresspart,
                        concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
                        cs.clinic_member_status_name,
                        lbh.vn,
                        k.department ,
                        lbh.order_date ,
                        concat(DAY(lbh.order_date),'/',MONTH(lbh.order_date),'/',(YEAR(lbh.order_date)+543)) as order_date_thai,

                        (
                            select lab_order.lab_order_result
                            from lab_head
                            left outer join lab_order on lab_order.lab_order_number = lab_head.lab_order_number
                            where lab_head.vn = lbh.vn and lab_order.lab_items_code = '3008'
                            and lab_order.lab_order_result < 100
                            group by lab_head.vn
                        )  as ldl_lab_result

                    FROM clinicmember cm
                    LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
                    LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id = cm.clinic_member_status_id
                    LEFT OUTER JOIN provis_typedis pd on pd.code = cs.provis_typedis
                    LEFT OUTER JOIN thaiaddress t  ON t.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)

                    LEFT OUTER JOIN (
                        SELECT    lab_head.lab_order_number,lab_head.hn,max(lab_head.vn) as vn
                        FROM      lab_head
                        LEFT OUTER JOIN lab_order ON lab_order.lab_order_number = lab_head.lab_order_number
                        WHERE     lab_head.order_date BETWEEN $datestart AND $dateend
                                  AND lab_order.lab_items_code = '3008'  AND lab_order.lab_order_result < 100
                                  GROUP BY  lab_head.hn
                        ) lh ON (lh.hn = cm.hn)

                    LEFT OUTER JOIN lab_head lbh ON lbh.vn = lh.vn
                    LEFT OUTER JOIN lab_order lor ON lor.lab_order_number = lh.lab_order_number
                    LEFT OUTER JOIN kskdepartment k ON k.depcode = lbh.order_department

                    WHERE
                        cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
                         AND cm.hn  $get_type in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
                         AND pd.code = '03'
                    GROUP BY cm.hn ORDER BY t.addressid  ";

            try {
                $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }

            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => False,
            ]);
           
            return $this->render('report22', [
                        'dataProvider' => $dataProvider,
                        'report_name' => $report_name,
                        'details' => $details,
            ]); 
        }
    
    }
    
    
    
     public function actionReport23($uclinic,$datestart, $dateend, $details) {
          $this->SaveLog($this->dep_controller, 'report23', $this->getSession());

           if ($uclinic != "") {
            if ($uclinic == 1) {
                $get_type = 'not';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวาน(DM Only) ผลตรวจแลป dtx,glucose(fpg) 2 ครั้งล่าสุด ระหว่าง 70 ถึง 130 ตามช่วงวันที่ที่เลือก';
            } else if ($uclinic == 2) {
                $get_type = '';
                $report_name = 'รายงานจำนวนคนไข้คลินิคเบาหวานและมีความดันร่วม(DM WITH HT)  ผลตรวจแลป dtx,glucose(fpg) 2 ครั้งล่าสุด ระหว่าง 70 ถึง 130  ตามช่วงวันที่ที่เลือก';
            }
                                   
            $sql = "SELECT
                        cm.clinic,cm.hn,
                        pt.addrpart,
                        pt.moopart,
                        t.full_name as addresspart,
                        concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
                        cs.clinic_member_status_name ,
                        lh.vn as vn_last ,

                        (
                            select lab_order.lab_order_result
                            from lab_head
                            left outer join lab_order on lab_order.lab_order_number = lab_head.lab_order_number
                            where lab_head.vn = lh.vn   AND lab_order.lab_items_code  in ('3246','3001')
                            group by lab_head.vn
                        )  as glucose_lab_result_last  ,

                        


                        (
                              select  lo.lab_order_result
                              from vn_stat v
                              left outer join lab_head lh on lh.vn = v.vn
                              left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number
                              where v.vstdate between $datestart AND $dateend
                              and v.hn = cm.hn
                              and
                                     (
                                                v.pdx between 'e110' and 'e119' or
                                                v.dx0 between 'e110' and 'e119' or
                                                v.dx1 between 'e110' and 'e119' or
                                                v.dx2 between 'e110' and 'e119' or
                                                v.dx3 between 'e110' and 'e119' or
                                                v.dx4 between 'e110' and 'e119' or
                                                v.dx5 between 'e110' and 'e119'

                                     )
                              and lo.lab_items_code  in ('3246','3001')  
                              and lo.lab_order_result between 70 and 130
                              group by v.vn
                              order by v.vn desc limit 1,1
                        )   AS glucose_lab_second_last



                    FROM clinicmember cm
                    LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
                    LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id = cm.clinic_member_status_id
                    LEFT OUTER JOIN provis_typedis pd on pd.code = cs.provis_typedis
                    LEFT OUTER JOIN thaiaddress t  ON t.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)

                    LEFT OUTER JOIN (
                        SELECT
                                      lab_head.hn,max(lab_head.vn) as vn

                        FROM      lab_head
                        LEFT OUTER JOIN lab_order ON lab_order.lab_order_number = lab_head.lab_order_number
                        LEFT OUTER JOIN vn_stat v ON v.vn = lab_head.vn
                        WHERE     lab_head.order_date BETWEEN $datestart AND $dateend
                                  AND lab_order.lab_items_code  in ('3246','3001')  
                                  AND lab_order.lab_order_result between 70 and 130
                                  AND
                                     (
                                                v.pdx between 'e110' and 'e119' or
                                                v.dx0 between 'e110' and 'e119' or
                                                v.dx1 between 'e110' and 'e119' or
                                                v.dx2 between 'e110' and 'e119' or
                                                v.dx3 between 'e110' and 'e119' or
                                                v.dx4 between 'e110' and 'e119' or
                                                v.dx5 between 'e110' and 'e119'
                                     )
                                  GROUP BY  lab_head.hn
                        ) lh ON (lh.hn = cm.hn)



                    WHERE
                        cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
                         AND cm.hn  $get_type in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))

                         AND pd.code = '03'

                    GROUP BY cm.hn
                    having (glucose_lab_result_last between 70 and 130  and  glucose_lab_second_last  between 70 and 130)
                    ORDER BY t.addressid ";


            try {
                $rawData = \yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }

            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => False,
            ]);
           
            return $this->render('report23', [
                        'dataProvider' => $dataProvider,
                        'report_name' => $report_name,
                        'details' => $details,
            ]); 
        }
    
    }
    
    
    
    
    
    
    
    
    
    

} // end class
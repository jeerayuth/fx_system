<?php

namespace frontend\controllers;

use Yii;
use frontend\components\CommonController;

class HtController extends CommonController {

    public $dep_controller = 'ht';

    public function actionReport1() {

        // save log
        $this->SaveLog($this->dep_controller, 'report1', $this->getSession());

        $report_name = "รายงานสรุปคนไข้ทะเบียนความดันแยกตามที่อยู่ในแต่ละสถานบริการ(คน)";


        $sql = " SELECT
'1' as hosp_area,'รพ.สต.ตำบลทุ่งหลวง' as hosp_name , th.full_name as address,count(distinct(cm.hn)) as count_hn
FROM clinicmember  cm
LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
WHERE 
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND 
    cm.hn  not  in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND 
    cm.hn  not  in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND 
    cm.hn  not  in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND 
    cm.hn  not  in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND 
    cm.hn  not  in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND 
    cm.hn  not  in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND 
    cm.hn  not  in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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
                    'report_name' => $report_name,
        ]);
    }

    /* รายงานสรุปทะเบียนความดันแบบ(แสดงรายชื่อคนไข้) */

    public function actionReport2($hosp_area) {
        // save log
        $this->SaveLog($this->dep_controller, 'report2', $this->getSession());

        $report_name = "รายงานสรุปคนไข้ทะเบียนความดันแยกตามที่อยู่";
        $hosp_area_condition = "";

        if ($hosp_area == 1) {
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
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND 
    cm.hn not in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
    
AND pd.code in('3','03')

$hosp_area_condition
    
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

        return $this->render('report2', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
        ]);
    }

    public function actionReport3($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report3', $this->getSession());

        $report_name = "รายงานจำนวนคนไข้คลินิกความดันโลหิตสูง ได้รับการคัดกรองการสูบบุหรี่-ดื่มสุรา";

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
        cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
and
    	cm.hn  not  in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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
    }

// จบ function



    public function actionReport4($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report4', $this->getSession());

        $report_name = 'รายงานจำนวนคนไข้คลินิกความดันโลหิตสูง ได้รับการคัดกรองภาวะโรคซึมเศร้า';

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
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))      
and
  cm.hn  not in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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

// จบ function




    public function actionReport5($datestart, $dateend, $details, $operators = null, $result_first = null, $lab_items = null) {
        // save log
        $this->SaveLog($this->dep_controller, 'report5', $this->getSession());
        // ตัวแปร $report_name เอาไว้ไปแสดงชื่อรายงานในหน้า view
        $logics = "";
        $get_labs = "";

        $report_name = "รายงานจำนวนคนไข้คลินิกความดันโลหิตสูง ได้รับการตรวจแลปชนิดต่างๆ";

        if ($lab_items != "") {
            if ($lab_items == 1) {
                $get_labs = 3248; // GFR
            } else if ($lab_items == 2) {
                $get_labs = '3209,3038'; // Urine Protine      
            } else if ($lab_items == 3) {
                $get_labs = '2070,3005,3006,2071,3007,2072,3008'; // Lipid Profile      
            } else if ($lab_items == 4) {
                $get_labs = 3001; // Glucose(FPG)      
            } else if ($lab_items == 5) {
                $get_labs = 3003; // Creatinine     
            }
        }

        if ($operators != "" && $result_first != "") {
            $logics = "  AND lo.lab_order_result  $operators  $result_first  ";
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
      
) AS lab_order_result_report

FROM ovst o

left outer join clinicmember cm ON cm.hn=o.hn
left outer join clinic_member_status cs on cs.clinic_member_status_id = cm.clinic_member_status_id
left outer join provis_typedis pd on pd.code = cs.provis_typedis
left outer join vn_stat v      ON v.vn = o.vn
left outer join thaiaddress t  on t.addressid = v.aid
left outer join patient p      ON p.hn = o.hn
left outer join lab_head lh    ON lh.vn = v.vn
left outer join lab_order lo   ON lo.lab_order_number = lh.lab_order_number
left outer join lab_items li   ON li.lab_items_code = lo.lab_items_code

WHERE lo.lab_items_code in ($get_labs) AND lo.confirm = 'Y'

AND o.vstdate BETWEEN   $datestart and $dateend 
AND cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND cm.hn not in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND lo.lab_order_result!='' AND lo.lab_order_result!='-'  AND lo.lab_order_result!='.'

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

        return $this->render('report5', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
                    'lab_item' => $get_labs,
                    'operators' => $operators,
                    'result_first' => $result_first,
                    'datestart' => $datestart,
                    'dateend' => $dateend,
        ]);
    }

// จบ function


    public function actionReport6($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report6', $this->getSession());

        $report_name = 'รายงานจำนวนคนไข้คลินิคความดัน CKD Diag (N181 - N185)';

        $sql = "select v.hn,o.an, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,v.age_y as age_y,
                s.name as sex,
                v.moopart,t.full_name as address, v.vstdate,
                v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5,
                

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
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
  cm.hn  not  in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))


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
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
  cm.hn  not  in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
  cm.hn  not  in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
  cm.hn  not  in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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
  cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
  cm.hn  not  in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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

        return $this->render('report6', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
                    'datestart' => $datestart,
                    'dateend' => $dateend,
        ]);
    }

// จบ function

    public function actionReport7($details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report7', $this->getSession());

        $report_name = 'รายงานคนไข้ทะเบียนความดัน + โรคหัวใจ';


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
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND 
    cm.hn not in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND
    cm.hn in(select cl.hn from clinicmember cl  where cl.hn = cm.hn and cl.clinic = '015')

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

        return $this->render('report7', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

// จบ function

    public function actionReport8($details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report8', $this->getSession());

        $report_name = 'รายงานคนไข้ทะเบียนความดัน + หลอดเลือดสมอง';

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
    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND 
    cm.hn not in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
AND
    cm.hn IN(select cl.hn from clinicmember cl  where cl.hn = cm.hn and cl.clinic = '014')

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

        return $this->render('report8', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
        ]);
    }

// จบ function

    public function actionReport9($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report9', $this->getSession());

        $report_name = 'รายงานคนไข้ทะเบียนความดันรายใหม่(ตามวันที่ลงทะเบียน)';

        $sql = "         
SELECT
pt.hn as hn,concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
concat( timestampdiff(year,pt.birthday,now()), ' ปี') as age_y,
pt.cid,
(
   select cr.regdate from clinicmember cr where cr.hn = cm.hn and cr.clinic = 
            (select sys_value from sys_var where sys_name='ht_clinic_code')  group by cr.hn
) as regdate,

(
   select cr.begin_year from clinicmember cr where cr.hn = cm.hn and cr.clinic = 
            (select sys_value from sys_var where sys_name='ht_clinic_code')  group by cr.hn
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
                    where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code') 
                    and regdate between $datestart and $dateend      
            )
AND 
    cm.hn  not  in (select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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

        return $this->render('report9', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
        ]);
    }

    public function actionReport10($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report10', $this->getSession());

        $report_name = 'รายงาน CVD-RISK คนไข้ความดัน';

        $sql = "  
            
select pn.hn, concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,date(pn.note_datetime) as note_date,  pn.note_staff ,cl.other_chronic_text ,pn.plain_text ,
pt.moopart,t.full_name as address

 from ptnote  pn

 left outer join patient pt on pt.hn = pn.hn
 left outer join clinicmember cl  on cl.hn = pn.hn
 left outer join thaiaddress t on t.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)

 where pn.plain_text like 'cvd%'

AND 
  cl.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
  cl.hn not  in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code')
  )
 and note_datetime between $datestart and $dateend 

 group by pn.hn
 order by pn.plain_text  ,pt.tmbpart ,pt.moopart 
 
 ";


        $sql2 = "         

select pn.plain_text , count(distinct(pn.hn)) as count_hn

 from ptnote  pn

 left outer join patient pt on pt.hn = pn.hn
 left outer join clinicmember cl  on cl.hn = pn.hn
 left outer join thaiaddress t on t.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)

 where pn.plain_text like 'cvd%'

AND 
  cl.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
AND
  cl.hn not  in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code')
  )
  
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


        return $this->render('report10', [
                    'dataProvider' => $dataProvider,
                    'dataProvider2' => $dataProvider2,
                    'rawData2' => $rawData2,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport11($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report11', $this->getSession());

        $report_name = 'รายงานคนไข้ทะเบียนความดัน';

        $sql = "         
SELECT
pt.hn as hn,concat(pt.pname,pt.fname,'  ',pt.lname) as pt_name,
concat( timestampdiff(year,pt.birthday,now()), ' ปี') as age_y,
pt.cid,
(
   select cr.regdate from clinicmember cr where cr.hn = cm.hn and cr.clinic = 
            (select sys_value from sys_var where sys_name='ht_clinic_code')  group by cr.hn
) as regdate,

(
   select cr.begin_year from clinicmember cr where cr.hn = cm.hn and cr.clinic = 
            (select sys_value from sys_var where sys_name='ht_clinic_code')  group by cr.hn
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
                    where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code') 
                    and regdate between $datestart and $dateend      
            )
AND 
    cm.hn  not  in (select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))

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
        ]);
    }

    public function actionReport12($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report12', $this->getSession());

        $report_name = 'รายงานจำนวนคนไข้คลินิคความดัน ตรวจสอบ BP >= 180';

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
                        AND cm.hn in (select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
                        AND cm.hn not in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
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

        return $this->render('report12', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport13($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report13', $this->getSession());

        $report_name = 'รายงานจำนวนคนไข้คลินิคความดัน ประวัติคัดกรอง BP';

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
                           cm.hn in (select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
                       AND cm.hn not in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
                       AND pd.code  = '03'
                  GROUP BY cm.hn 
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

        return $this->render('report13', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }
    
    
    
    
    public function actionReport14($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report14', $this->getSession());

        $report_name = 'รายงานจำนวนคนไข้คลินิคความดัน คัดกรองรอบเอว/ส่วนสูง';

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
                       cm.hn in (select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
                       AND cm.hn not in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))           
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

        return $this->render('report14', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    
    public function actionReport15($datestart, $dateend, $details) {
        // save log
        $this->SaveLog($this->dep_controller, 'report15', $this->getSession());

        $report_name = 'รายงานจำนวนคนไข้คลินิคความดัน ผลตรวจแลป LDL น้อยกว่า 100 ครั้งล่าสุด ตามช่วงวันที่ที่เลือก';

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
                        cm.hn in (select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))
                    AND cm.hn not in (select hn from clinicmember cl where cl.clinic=(select sys_value from sys_var where sys_name='dm_clinic_code')) 
                         AND pd.code = '03'
                    GROUP BY cm.hn 
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

        return $this->render('report15', [
                    'dataProvider' => $dataProvider,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    
    
  

}

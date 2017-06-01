<?php

namespace frontend\controllers;

use Yii;
use frontend\components\CommonController;

class PcuController extends CommonController {
    
    public $dep_controller = 'pcu';

    public function actionReport1($details, $age_id) {
        
         // save log
        $this->SaveLog($this->dep_controller, 'report1', $this->getSession());

        if ($age_id != "") { // เริ่มต้นตรวจสอบ อายุ  
            if ($age_id == 1) {
                $age = '30 and 60';
                $report_name = 'รายงานสรุปหญิงอายุ 30-60 ปี ในเขตรับผิดชอบ';
            } else if ($age_id == 2) {
                $age = '30 and 70';
                $report_name = 'รายงานสรุปหญิงอายุ 30-70 ปี ในเขตรับผิดชอบ';
            }
        }


        $sql = "SELECT
                    v.village_id,v.village_moo, v.village_name ,                 
                    (
                      select count(p.cid) from person p where p.sex = '2'  
                      and  timestampdiff(year,p.birthdate,curdate()) between  $age 
                      and p.village_id = v.village_id
                    ) as age_min_sex_female
                FROM village v
                WHERE v.village_id != 1 ";




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
                    'age_id' => $age_id,
        ]);
    }

    public function actionReport2($village_id, $age_id) {
         // save log
        $this->SaveLog($this->dep_controller, 'report2', $this->getSession());


        if ($age_id != "") { // เริ่มต้นตรวจสอบ อายุ  
            if ($age_id == 1) {
                $age = '30 and 60';
                $report_name = 'รายงานสรุปหญิงอายุ 30-60 ปี ในเขตรับผิดชอบ';
            } else if ($age_id == 2) {
                $age = '30 and 70';
                $report_name = 'รายงานสรุปหญิงอายุ 30-70 ปี ในเขตรับผิดชอบ';
            }
        }

        // $report_name = "รายงานรายชื่อหญิงอายุ 30-70 ปี ในเขตรับผิดชอบ";
        $sql = "select

                concat(p.pname,p.fname,'  ',p.lname) as pt_name ,v.village_moo,v.village_name,h.address,t.full_name,
                timestampdiff(year,p.birthdate,curdate()) as age_year,p.house_regist_type_id, r.house_regist_type_name

                from person p

                left outer join village v on v.village_id = p.village_id
                left outer join thaiaddress t on t.addressid = v.address_id
                left outer join house h on h.house_id = p.house_id
                left outer join house_regist_type r on r.house_regist_type_id = p.house_regist_type_id

                where p.sex = '2'  and  timestampdiff(year,p.birthdate,curdate()) between  $age  and p.village_id = $village_id
                order by timestampdiff(year,p.birthdate,curdate()) ";


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
                    'village_id' => $village_id,
        ]);
    }

    public function actionReport3($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report3', $this->getSession());

        $report_name = "รายงานสรุปประชากรอายุ >=35 ปี ในเขตรับผิดชอบ";
        $sql = "SELECT
                    v.village_id,v.village_moo, v.village_name ,                 
                    (
                      select count(p.cid) from person p where  timestampdiff(year,p.birthdate,curdate())   >=35  and p.village_id = v.village_id
                    ) as age_min_35
                FROM village v
                WHERE v.village_id != 1 ";

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

    public function actionReport4($village_id) {
         // save log
        $this->SaveLog($this->dep_controller, 'report4', $this->getSession());


        $report_name = "รายงานสรุปประชากรอายุ >=35 ปี ในเขตรับผิดชอบ";
        $sql = "select

                concat(p.pname,p.fname,'  ',p.lname) as pt_name ,v.village_moo,v.village_name,h.address,t.full_name,
                timestampdiff(year,p.birthdate,curdate()) as age_year,p.house_regist_type_id, r.house_regist_type_name

                from person p

                left outer join village v on v.village_id = p.village_id
                left outer join thaiaddress t on t.addressid = v.address_id
                left outer join house h on h.house_id = p.house_id
                left outer join house_regist_type r on r.house_regist_type_id = p.house_regist_type_id

                where timestampdiff(year,p.birthdate,curdate())  >=35   and p.village_id = $village_id
                order by timestampdiff(year,p.birthdate,curdate())

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

        return $this->render('report4', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'village_id' => $village_id,
        ]);
    }

    public function actionReport5($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report5', $this->getSession());


        $report_name = "รายงานตรวจสอบ => ผู้ป่วยที่อยู่ใน เวชระเบียน Patient แต่ไม่มีในบัญชี 1 Person";
        $sql = "SELECT 
                    cid,hn,concat(pname,fname,'  ',lname) as pt_name,type_area,
                    addrpart,moopart, thaiaddress.full_name as full_name
                FROM patient
                left outer join thaiaddress on  thaiaddress.addressid = concat(patient.chwpart,patient.amppart,patient.tmbpart)

                WHERE 
                        cid not in(SELECT cid FROM person) and (death='N' or death is NULL or death='  ')
                        
                AND nationality='99' and 
                        (cid not like '0%' and cid<>' ' and cid is not null and cid not like '111111111%')

                ORDER BY
                        patient.chwpart, patient.amppart, patient.tmbpart, patient.moopart ";




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

        $report_name = "รายงานตรวจสอบ => ในบัญชี1 Type(1,2) แต่ในเวชระเบียนลงที่อยู่นอกเขต";
        $sql = "SELECT 
                    p.cid,p.hn,concat(p.pname,p.fname,'  ',p.lname) as pt_name,p.type_area,
                    p.addrpart,p.moopart, thaiaddress.full_name as full_name
                FROM patient p
                join person ps on ps.cid=p.cid
                left outer join thaiaddress on  thaiaddress.addressid = concat(p.chwpart,p.amppart,p.tmbpart)
                WHERE 
                    ps.house_regist_type_id in(1,2) AND 
                    (p.death<>'Y' or p.death=' ' or p.death is NULL)
                    and CONCAT(p.chwpart,p.amppart,p.tmbpart,LPAD(moopart,2,0)) not in 
                    (SELECT village_code FROM village)";

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


        $report_name = "รายงานตรวจสอบ => ผู้ป่วย TypeAreaในบัญชี 1 เป็นค่าว่าง";
        $sql = "SELECT
            cid,concat(pname,fname,' ',lname) as person_name, house_regist_type_id
        FROM person
        WHERE 
            house_regist_type_id is null  
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
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport8($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report8', $this->getSession());


        $report_name = "รายงานตรวจสอบ => สถานะในครอบครัว 1 = เจ้าบ้าน  , 2 = ผู้อาศัย ในบัญชี 1 ว่าง";
        $sql = "SELECT
            cid,concat(pname,fname,' ',lname) as person_name, house_regist_type_id
        FROM person
        WHERE 
            person.person_house_position_id is null or 
            person.person_house_position_id not in(1,2) ";

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

    public function actionReport9($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report9', $this->getSession());

        $report_name = "รายงานตรวจสอบ => การศึกษาว่าง ในบัญชี 1 เป็นค่าว่าง";
        $sql = "SELECT
                cid,concat(pname,fname,' ',lname) as person_name, house_regist_type_id
            FROM person
                WHERE (education=' '  or education is NULL) or 
                education not in(SELECT education FROM education) ";

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
        ]);
    }

    public function actionReport10($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report10', $this->getSession());

        $report_name = "รายงานตรวจสอบ =>การศึกษา อายุ 6-12 ปี ไม่ใช่ชั้นประถม ในบัญชี 1 มีผลกับ HDC";
        $sql = "SELECT
                    cid,concat(pname,fname,' ',lname) as person_name, house_regist_type_id,age_y
                FROM person
                WHERE age_y BETWEEN 6 and 12 and education != 
                    (SELECT education FROM education WHERE provis_code=2) ";

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
                    'details' => $details,
        ]);
    }

    public function actionReport11($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report11', $this->getSession());

        $report_name = "รายงานตรวจสอบ => อาชีพว่าง ในบัญชี 1 เป็นค่าว่าง";
        $sql = "SELECT
            cid,concat(pname,fname,' ',lname) as person_name, house_regist_type_id
        FROM person
        WHERE (occupation=' ' or occupation is null) or
                occupation not in(SELECT occupation FROM occupation) ";

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

    public function actionReport12($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report12', $this->getSession());

        $report_name = "รายงานตรวจสอบ => คำนำหน้าชื่อว่าง ในบัญชี 1 เป็นค่าว่าง";
        $sql = "SELECT 
                    cid,concat(pname,fname,' ',lname) as person_name, house_regist_type_id 
                FROM person 
                WHERE (pname=' '  or pname is null) ";

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
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport13($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report13', $this->getSession());

        $report_name = "รายงานตรวจสอบ => สิทธิการรักษา ไม่มีใน pttype ในบัญชี 1 ทำให้ส่งออกไม่ได้";
        $sql = "SELECT
                cid,concat(pname,fname,' ',lname) as person_name, house_regist_type_id,
                concat(DAY(birthdate),'/',MONTH(birthdate),'/',(YEAR(birthdate)+543)) as birthdate,
                timestampdiff(year,birthdate,curdate()) as age_y
            FROM person
            WHERE (  pttype not in(SELECT pttype FROM pttype) or 
                    (pttype='' and pttype is null)) and 
                    (death='N' or death is NULL or death='')";

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
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport14($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report14', $this->getSession());

        $report_name = "รายงานตรวจสอบ => สิทธิการรักษา ในบัญชี 1 ว่าง";
        $sql = "SELECT
                cid,concat(pname,fname,' ',lname) as person_name, house_regist_type_id,
                concat(DAY(birthdate),'/',MONTH(birthdate),'/',(YEAR(birthdate)+543)) as birthdate,
                timestampdiff(year,birthdate,curdate()) as age_y
            FROM person
            WHERE (pttype='' or pttype is null) ";

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
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport15($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report15', $this->getSession());

        $report_name = "รายงานตรวจสอบ => มีสัญชาติไทย แต่เลขที่บัตรประชาชน ขึ้นต้นด้วย 0 Type 1 , 3";
        $sql = "SELECT
                cid,concat(pname,fname,' ',lname) as person_name, house_regist_type_id
            FROM person
            WHERE nationality='99' and cid LIKE '0%' AND house_regist_type_id in(1,3) and (death='N' or death is NULL or death=' ') ";

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
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport16($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report16', $this->getSession());

        $report_name = "รายงานตรวจสอบ => คนที่มีบ้านเลขที่บ้าน แต่ไม่มีหลังคาเรือนในระบบ";
        $sql = "SELECT
                cid,concat(pname,fname,' ',lname) as person_name, house_regist_type_id
            FROM person
            WHERE house_id not in(SELECT house_id FROM house) ";

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
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport17($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report17', $this->getSession());

        $report_name = "รายงานตรวจสอบ => คนต่างด้าว ไม่ลงประเภทคนต่างด้าวในบัญชี1";
        $sql = "SELECT cid,concat(pname,fname,' ',lname) as person_name, house_regist_type_id,
                        n.name as nationality_name
                    FROM person p
                    LEFT JOIN person_labor_type l on l.person_labor_type_id=p.person_labor_type_id
                    LEFT JOIN nationality n on n.nationality = p.nationality
                    WHERE p.nationality<>'99' and (p.person_discharge_id is NULL or  p.person_discharge_id=' ' or p.person_discharge_id='9')

                    AND (p.person_labor_type_id=' ' or p.person_labor_type_id is null or p.person_labor_type_id not in(SELECT person_labor_type_id FROM person_labor_type)) ";

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
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport18($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report18', $this->getSession());

        $report_name = "รายงานตรวจสอบ => ลงติ๊กเสียชีวิตแล้ว ในบัญชี 1 แต่สถานะยังไม่จำหน่าย";
        $sql = "SELECT cid,concat(pname,fname,' ',lname) as person_name, house_regist_type_id 
                FROM person 
                WHERE death='Y' and (discharge_date is NULL or discharge_date=' ')
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


        return $this->render('report18', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport19($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report19', $this->getSession());

        $report_name = "รายงานตรวจสอบ => ลงติ๊กเสียชีวิตแล้ว ในบัญชี 1 แต่สถานะยังมีชีวิตอยู่ ";
        $sql = "SELECT cid,concat(pname,fname,' ',lname) as person_name, house_regist_type_id 
                FROM person 
                WHERE death='Y' and person_discharge_id<>'1' ";


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
                    'details' => $details,
        ]);
    }

    public function actionReport20($datestart, $dateend, $details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report20', $this->getSession());

        $report_name = "รายงานอาการคล้ายไข้หวัดใหญ่ (ILI)";
        $sql = "SELECT
         concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vstdate,
        (select count(n.vn) from vn_stat n where n.vstdate = v.vstdate) as count_all_visit ,

        (
                select count(a.vn)
                       from vn_stat a
                       where (
                                    (a.pdx = 'j00' ) or
                                    (a.dx0 = 'j00' ) or
                                    (a.dx1 = 'j00' ) or
                                    (a.dx2 = 'j00' ) or
                                    (a.dx3 = 'j00' ) or
                                    (a.dx4 = 'j00' ) or
                                    (a.dx5 = 'j00' )

                             ) and a.vstdate = v.vstdate)  as  count_j00 ,



        (
                select count(a.vn)
                       from vn_stat a
                       where (
                                    (a.pdx between 'j020' and  'j029') or
                                    (a.dx0 between 'j020' and  'j029') or
                                    (a.dx1 between 'j020' and  'j029') or
                                    (a.dx2 between 'j020' and  'j029') or
                                    (a.dx3 between 'j020' and  'j029') or
                                    (a.dx4 between 'j020' and  'j029') or
                                    (a.dx5 between 'j020' and  'j029')

                             ) and a.vstdate = v.vstdate) as count_j020_j029     ,



        (
                select count(a.vn)
                       from vn_stat a
                       where (
                                    (a.pdx between 'j060' and  'j069') or
                                    (a.dx0 between 'j060' and  'j069') or
                                    (a.dx1 between 'j060' and  'j069') or
                                    (a.dx2 between 'j060' and  'j069') or
                                    (a.dx3 between 'j060' and  'j069') or
                                    (a.dx4 between 'j060' and  'j069') or
                                    (a.dx5 between 'j060' and  'j069')

                             ) and a.vstdate = v.vstdate) as count_j060_j069 ,


        (
                select count(a.vn)
                       from vn_stat a
                       where (
                                    (a.pdx ='j09') or
                                    (a.dx0 ='j09') or
                                    (a.dx1 ='j09') or
                                    (a.dx2 ='j09') or
                                    (a.dx3 ='j09') or
                                    (a.dx4 ='j09') or
                                    (a.dx5 ='j09')

                             ) and a.vstdate = v.vstdate) as count_j09   ,


        (
                select count(a.vn)
                       from vn_stat a
                       where (
                                    (a.pdx ='j10') or
                                    (a.dx0 ='j10') or
                                    (a.dx1 ='j10') or
                                    (a.dx2 ='j10') or
                                    (a.dx3 ='j10') or
                                    (a.dx4 ='j10') or
                                    (a.dx5 ='j10')

                             ) and a.vstdate = v.vstdate) as count_j10  ,


         (
                select count(a.vn)
                       from vn_stat a
                       where (
                                    (a.pdx ='j11') or
                                    (a.dx0 ='j11') or
                                    (a.dx1 ='j11') or
                                    (a.dx2 ='j11') or
                                    (a.dx3 ='j11') or
                                    (a.dx4 ='j11') or
                                    (a.dx5 ='j11')

                             ) and a.vstdate = v.vstdate) as count_j11



                 /*

        (
                select count(a.vn)
                       from vn_stat a
                       where (
                                    (a.pdx between 'j120' and  'j189') or
                                    (a.dx0 between 'j120' and  'j189') or
                                    (a.dx1 between 'j120' and  'j189') or
                                    (a.dx2 between 'j120' and  'j189') or
                                    (a.dx3 between 'j120' and  'j189') or
                                    (a.dx4 between 'j120' and  'j189') or
                                    (a.dx5 between 'j120' and  'j189')

                             ) and a.vstdate = v.vstdate) as count_j120_j189
                 */


        FROM vn_stat v

        WHERE v.vstdate between $datestart  and $dateend

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


        return $this->render('report20', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport21($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report21', $this->getSession());

        $report_name = "รายงานตรวจสอบ => สถานะสมณะ แต่คำนำหน้าไม่ใช่ สมณะ ";
        $sql = "SELECT
            p.cid,p.pname,concat(p.fname,'  ',p.lname) as person_name ,m.name , 
            p.marrystatus , p.sex,p.house_regist_type_id, s.name as sex

            FROM person p

            JOIN pname n on n.name=p.pname
            JOIN marrystatus m on m.code = p.marrystatus
            JOIN sex s on s.code = p.sex
            
            WHERE  p.marrystatus = 6 and (death='N' or death is NULL or death=' ')
            and n.provis_code not between 800 and 959 ";


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
                    'details' => $details,
        ]);
    }

    public function actionReport22($details) {
        
         // save log
        $this->SaveLog($this->dep_controller, 'report22', $this->getSession());

        $report_name = "รายงานตรวจสอบ => คำนำหน้าชื่อเป็นพระ แต่สถานะไม่ใช่สมณะ ";
        $sql = "SELECT
            p.cid,p.pname,concat(p.fname,'  ',p.lname) as person_name ,m.name , 
            p.marrystatus , s.name as sex

            FROM person p

            JOIN pname n on n.name=p.pname
            JOIN marrystatus m on m.code = p.marrystatus
            JOIN sex s on s.code = p.sex

            WHERE  p.marrystatus != 6 and (death='N' or death is NULL or death=' ') 
            and n.provis_code  between 800 and 959 ";


        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);


        return $this->render('report22', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport23($details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report23', $this->getSession());

        $report_name = "รายงานตรวจสอบ => ตรวจสอบสถานะเป็นพระ แต่ อายุ ไม่ถึง 20 ปี";
        $sql = "SELECT
                p.cid,p.pname,concat(p.fname,'  ',p.lname) as person_name ,
                m.name , p.marrystatus , p.sex ,p.age_y,  s.name as sex

                FROM person p

                JOIN pname n on n.name=p.pname
                JOIN marrystatus m on m.code = p.marrystatus
                JOIN sex s on s.code = p.sex

                WHERE  p.marrystatus = 6 and (death='N' or death is NULL or death=' ')
                and n.provis_code  between 800 and 959  and n.provis_code != 832  
                and n.provis_code != 863 and p.sex = 1 and p.age_y <= 19 ";


        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);


        return $this->render('report23', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }

    public function actionReport24($details, $begin_year) {
         // save log
        $this->SaveLog($this->dep_controller, 'report24', $this->getSession());

        $report_name = "รายงานสรุปผลการคัดกรองโรคเรื้อรังในชุมชนรับผิดชอบ";
        $sql = "SELECT
                        '1' AS options,
                        'DM กลุ่มเสี่ยงสูง' AS title,
                        COUNT(p1.person_dm_screen_status_id) AS count_hn

                  FROM person_dmht_screen_summary p1
                  WHERE
                            p1.bdg_year = $begin_year
                        AND p1.status_active='Y'
                        AND p1.person_dm_screen_status_id = 2

                  UNION

                  SELECT
                        '2' AS options,
                        'DM กลุ่มสงสัยรายใหม่' AS title,
                        COUNT(p1.person_dm_screen_status_id) AS count_hn

                  FROM person_dmht_screen_summary p1
                  WHERE
                            p1.bdg_year = $begin_year
                        AND p1.status_active='Y'
                        AND p1.person_dm_screen_status_id = 3


                  UNION

                  SELECT
                        '3' AS options,
                        'HT กลุ่มเสี่ยงสูง' AS title,
                        COUNT(p1.person_ht_screen_status_id) AS count_hn

                  FROM person_dmht_screen_summary p1
                  WHERE
                            p1.bdg_year = $begin_year
                        AND p1.status_active='Y'
                        AND p1.person_ht_screen_status_id = 3


                  UNION

                  SELECT
                        '4' AS options,
                        'HT กลุ่มสงสัยรายใหม่' AS title,
                        COUNT(p1.person_ht_screen_status_id) AS count_hn

                  FROM person_dmht_screen_summary p1
                  WHERE
                            p1.bdg_year = $begin_year
                        AND p1.status_active='Y'
                        AND p1.person_ht_screen_status_id = 4

                  UNION

                  SELECT
                        '5' AS options,
                        'DM กลุ่มเสี่ยงสูงและ HT กลุ่มเสี่ยงสูง' AS title,
                        COUNT(p1.person_dm_screen_status_id) AS count_hn

                  FROM person_dmht_screen_summary p1
                  WHERE
                            p1.bdg_year = $begin_year
                        AND p1.status_active='Y'
                        AND p1.person_dm_screen_status_id = 2
                        AND p1.person_ht_screen_status_id = 3


                  UNION


                  SELECT
                        '6' AS options,
                        'Stroke กลุ่มเสี่ยง(หญิง>=55ปี,ชาย>=45ปี)' AS title,
                        COUNT(p1.person_stroke_screen_status_id) AS count_hn

                  FROM person_dmht_screen_summary p1
                       LEFT OUTER JOIN person p2 on p2.person_id = p1.person_id
                  WHERE
                            p1.bdg_year = $begin_year
                        AND p1.status_active='Y'
                        AND p1.person_stroke_screen_status_id = 2
                        AND
                           (
                               (p2.sex = 1 and p2.age_y >= 45) OR
                               (p2.sex = 2 and p2.age_y >= 55)
                           )


                  UNION

                  SELECT

                            '7' AS options,
                            'ภาวะอ้วนลงพุง, BMI มากกว่าหรือเท่ากับ 23' AS title,
                                count(distinct(p2.cid)) as count_cid

                            FROM person_dmht_screen_summary p1
                            LEFT OUTER JOIN person p2 on p2.person_id = p1.person_id
                            LEFT OUTER JOIN house h1 on h1.house_id = p2.house_id
                            LEFT OUTER JOIN village v on v.village_id = h1.village_id
                            LEFT OUTER JOIN sex s on s.code = p2.sex
                            LEFT OUTER JOIN person_dmht_risk_screen_head ph ON ph.person_dmht_screen_summary_id = p1.person_dmht_screen_summary_id
                            WHERE
                                 p1.bdg_year = $begin_year
                                 AND p1.status_active='Y'

                                 AND
                                 (

                                    ((p2.sex = '2' AND ph.bmi >= 23) OR  (p2.sex = '2' AND ph.waist > 80) OR  (p2.sex = '2' AND ph.bmi >= 23 AND ph.waist > 80))  OR
                                    ((p2.sex = '1' AND ph.bmi >= 23) OR  (p2.sex = '1' AND ph.waist > 90) OR  (p2.sex = '1' AND ph.bmi >= 23 AND ph.waist > 90))


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

        return $this->render('report24', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
                    'begin_year' => $begin_year,
        ]);
    }

    public function actionReport25($title, $options, $begin_year) {
         // save log
        $this->SaveLog($this->dep_controller, 'report25', $this->getSession());

        if ($options != '') {
            switch ($options) {
                case 1 :
                    $sql = "SELECT
                                p1.cid,concat(p2.pname,p2.fname,'  ',p2.lname) as person_name,
                                p2.age_y,h1.address,v.village_moo,v.village_name,s.name as sex,
                                p1.person_dm_screen_status_id,p1.bdg_year,
                                ph.bmi
                            FROM person_dmht_screen_summary p1
                            LEFT OUTER JOIN person p2 on p2.person_id = p1.person_id
                            LEFT OUTER JOIN house h1 on h1.house_id = p2.house_id
                            LEFT OUTER JOIN village v on v.village_id = h1.village_id
                            LEFT OUTER JOIN sex s on s.code = p2.sex
                            LEFT OUTER JOIN person_dmht_risk_screen_head ph ON ph.person_dmht_screen_summary_id = p1.person_dmht_screen_summary_id
                            WHERE
                                 p1.bdg_year = $begin_year
                                 AND p1.status_active='Y'
                                 AND p1.person_dm_screen_status_id = 2
                            GROUP BY p2.cid     
                            ORDER BY 
                                 v.village_moo ,p2.sex ";
                            

                    break;

                case 2 :
                    $sql = "SELECT
                                p1.cid,concat(p2.pname,p2.fname,'  ',p2.lname) as person_name,
                                p2.age_y,h1.address,v.village_moo,v.village_name,s.name as sex,
                                p1.person_dm_screen_status_id,p1.bdg_year,
                                ph.bmi
                            FROM person_dmht_screen_summary p1
                            LEFT OUTER JOIN person p2 on p2.person_id = p1.person_id
                            LEFT OUTER JOIN house h1 on h1.house_id = p2.house_id
                            LEFT OUTER JOIN village v on v.village_id = h1.village_id
                            LEFT OUTER JOIN sex s on s.code = p2.sex
                            LEFT OUTER JOIN person_dmht_risk_screen_head ph ON ph.person_dmht_screen_summary_id = p1.person_dmht_screen_summary_id
                            WHERE
                                 p1.bdg_year = $begin_year
                                 AND p1.status_active='Y'
                                 AND p1.person_dm_screen_status_id = 3
                            GROUP BY p2.cid      
                            ORDER BY 
                                 v.village_moo ,p2.sex ";

                    break;

                case 3 :
                    $sql = "SELECT
                                p1.cid,concat(p2.pname,p2.fname,'  ',p2.lname) as person_name,
                                p2.age_y,h1.address,v.village_moo,v.village_name,s.name as sex,
                                p1.person_ht_screen_status_id,p1.bdg_year,
                                ph.bmi
                            FROM person_dmht_screen_summary p1
                            LEFT OUTER JOIN person p2 on p2.person_id = p1.person_id
                            LEFT OUTER JOIN house h1 on h1.house_id = p2.house_id
                            LEFT OUTER JOIN village v on v.village_id = h1.village_id
                            LEFT OUTER JOIN sex s on s.code = p2.sex
                            LEFT OUTER JOIN person_dmht_risk_screen_head ph ON ph.person_dmht_screen_summary_id = p1.person_dmht_screen_summary_id
                            WHERE
                                 p1.bdg_year = $begin_year
                                 AND p1.status_active='Y'
                                 AND p1.person_ht_screen_status_id = 3
                            GROUP BY p2.cid      
                            ORDER BY 
                                 v.village_moo ,p2.sex ";

                    break;

                case 4 :
                    $sql = "SELECT
                                p1.cid,concat(p2.pname,p2.fname,'  ',p2.lname) as person_name,
                                p2.age_y,h1.address,v.village_moo,v.village_name,s.name as sex,
                                p1.person_ht_screen_status_id,p1.bdg_year,
                                ph.bmi
                            FROM person_dmht_screen_summary p1
                            LEFT OUTER JOIN person p2 on p2.person_id = p1.person_id
                            LEFT OUTER JOIN house h1 on h1.house_id = p2.house_id
                            LEFT OUTER JOIN village v on v.village_id = h1.village_id
                            LEFT OUTER JOIN sex s on s.code = p2.sex
                            LEFT OUTER JOIN person_dmht_risk_screen_head ph ON ph.person_dmht_screen_summary_id = p1.person_dmht_screen_summary_id
                            WHERE
                                 p1.bdg_year = $begin_year
                                 AND p1.status_active='Y'
                                 AND p1.person_ht_screen_status_id = 4
                            GROUP BY p2.cid      
                            ORDER BY 
                                 v.village_moo ,p2.sex ";

                    break;

                case 5 :
                    $sql = "SELECT
                                p1.cid,concat(p2.pname,p2.fname,'  ',p2.lname) as person_name,
                                p2.age_y,h1.address,v.village_moo,v.village_name,s.name as sex,
                                p1.person_ht_screen_status_id,p1.bdg_year,
                                ph.bmi
                            FROM person_dmht_screen_summary p1
                            LEFT OUTER JOIN person p2 on p2.person_id = p1.person_id
                            LEFT OUTER JOIN house h1 on h1.house_id = p2.house_id
                            LEFT OUTER JOIN village v on v.village_id = h1.village_id
                            LEFT OUTER JOIN sex s on s.code = p2.sex
                            LEFT OUTER JOIN person_dmht_risk_screen_head ph ON ph.person_dmht_screen_summary_id = p1.person_dmht_screen_summary_id
                            WHERE
                                 p1.bdg_year = $begin_year
                                 AND p1.status_active='Y'
                                 AND p1.person_dm_screen_status_id = 2
                                 AND p1.person_ht_screen_status_id = 3
                            GROUP BY p2.cid      
                            ORDER BY 
                                 v.village_moo ,p2.sex";

                    break;

                case 6 :
                    $sql = "SELECT
                                p1.cid,concat(p2.pname,p2.fname,'  ',p2.lname) as person_name,
                                p2.age_y,h1.address,v.village_moo,v.village_name,s.name as sex,
                                p1.person_ht_screen_status_id,p1.bdg_year,
                                ph.bmi
                            FROM person_dmht_screen_summary p1
                            LEFT OUTER JOIN person p2 on p2.person_id = p1.person_id
                            LEFT OUTER JOIN house h1 on h1.house_id = p2.house_id
                            LEFT OUTER JOIN village v on v.village_id = h1.village_id
                            LEFT OUTER JOIN sex s on s.code = p2.sex
                            LEFT OUTER JOIN person_dmht_risk_screen_head ph ON ph.person_dmht_screen_summary_id = p1.person_dmht_screen_summary_id
                            WHERE
                                 p1.bdg_year = $begin_year
                                 AND p1.status_active='Y'
                                 AND p1.person_stroke_screen_status_id = 2
                                 AND
                                    (
                                        (p2.sex = 1 and p2.age_y >= 45) OR
                                        (p2.sex = 2 and p2.age_y >= 55)
                                    )
                            GROUP BY p2.cid
                            ORDER BY 
                                 v.village_moo ,p2.sex ";

                    break;

                case 7 :
                    $sql = "SELECT
                                p1.cid,concat(p2.pname,p2.fname,'  ',p2.lname) as person_name,
                                p2.age_y,h1.address,v.village_moo,v.village_name,s.name as sex,
                                p1.person_ht_screen_status_id,p1.bdg_year,
                                ph.bmi,ph.waist
                            FROM person_dmht_screen_summary p1
                            LEFT OUTER JOIN person p2 on p2.person_id = p1.person_id
                            LEFT OUTER JOIN house h1 on h1.house_id = p2.house_id
                            LEFT OUTER JOIN village v on v.village_id = h1.village_id
                            LEFT OUTER JOIN sex s on s.code = p2.sex
                            LEFT OUTER JOIN person_dmht_risk_screen_head ph ON ph.person_dmht_screen_summary_id = p1.person_dmht_screen_summary_id
                            WHERE
                                 p1.bdg_year = $begin_year
                                 AND p1.status_active='Y'
                                 AND 
                                 (
                                    ((p2.sex = '1' AND ph.bmi >= 23 OR p2.sex = '1' AND ph.waist > 90) OR (p2.sex = '1' AND ph.bmi >= 23 AND ph.waist > 90)) 
                                        OR
                                    ((p2.sex = '2' AND ph.bmi >= 23 OR p2.sex = '2' AND ph.waist > 80) OR (p2.sex = '2' AND ph.bmi >= 23 AND ph.waist > 80))                                
                                  )
                                    
                            GROUP BY p2.cid      
                            ORDER BY 
                                 v.village_moo ,p2.sex ";

                    break;
                   
               
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

                return $this->render('report25', [
                            'dataProvider' => $dataProvider,
                            'rawData' => $rawData,
                            'report_name' => $title,
                            'begin_year' => $begin_year,
                ]);
            

        }
    }
    
    
    public function actionReport26($details,$age_id) {
        
         // save log
        $this->SaveLog($this->dep_controller, 'report26', $this->getSession());

        if ($age_id != "") { // เริ่มต้นตรวจสอบ อายุ  
            if ($age_id == 1) {
                $age = '>=35';
                $report_name = "รายงานสรุปจำนวนประชากรอายุ $age ปี ในเขตรับผิดชอบ";
            } 
        }


        $sql = "SELECT
                    v.village_id,
                    v.village_moo,
                    v.village_name,
                    l.location_area_name,
                    h.location_area_id,
                    count(h.location_area_id)   as count_location
                FROM person p
                left outer join village v on v.village_id = p.village_id
                left outer join house h on h.house_id = p.house_id
                left outer join house_location_area l on l.location_area_id = h.location_area_id

                WHERE p.village_id != 1   AND timestampdiff(year,p.birthdate,curdate())  $age

                GROUP BY v.village_id,h.location_area_id
                having count(h.location_area_id)  > 0  ";
             

        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('report26', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
                    'age_id' => $age_id,
                    
        ]);
    }
    
    
    
    
    public function actionReport27($village_id, $age_id, $location_area_id) {
         // save log
        $this->SaveLog($this->dep_controller, 'report27', $this->getSession());


        if ($age_id != "") { // เริ่มต้นตรวจสอบ อายุ  
            if ($age_id == 1) {
                $age = '>=35';
                $report_name = "รายงานสรุปหญิงอายุ $age ปี ในเขตรับผิดชอบ  แบ่งตามอายุ, เทศบาล/อบต.";
            } 
        }

        $sql = "select
                    p.house_id,p.cid,concat(p.pname,p.fname,' ',p.lname) as person_name ,
                    p.birthdate, 
                    timestampdiff(year,p.birthdate,curdate()) as age_y_cal, 
                    p.village_id ,
                    h.address,
                    v.village_moo,
                    v.village_name,
                    t.full_name,
                    h.location_area_id, l.location_area_name
                from person p
                left outer join village v on v.village_id = p.village_id
                left outer join thaiaddress t on t.addressid = v.address_id
                left outer join house h on h.house_id = p.house_id
                left outer join house_location_area l on l.location_area_id = h.location_area_id

                where p.village_id  = $village_id  and timestampdiff(year,p.birthdate,curdate()) $age
                        and  h.location_area_id = $location_area_id
                        and  h.location_area_id is not null

                order by p.village_id  ";
               


        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('report27', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'village_id' => $village_id,
  
        ]);
    }
    
    
    public function actionReport28() {
         // save log
        $this->SaveLog($this->dep_controller, 'report28', $this->getSession());

        $report_name = "บ้านไม่ได้ระบุ Location";
        $sql = "select
                    h.village_id , v.village_moo,
                    v.village_name,
                    h.address
                from person p
                left outer join village v on v.village_id = p.village_id
                left outer join house h on h.house_id = p.house_id
                left outer join house_location_area l on l.location_area_id = h.location_area_id

                where p.village_id != 1   and  h.location_area_id is null

                order by p.village_id ";
                           
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('report28', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                   
  
        ]);
    }
    
    
    public function actionReport29($datestart, $dateend, $details) {
         // save log
        $this->SaveLog($this->dep_controller, 'report29', $this->getSession());

        $report_name = "รายงานผู้มารับบริการ(เฉพาะสัญชาติไทย)ตามช่วงเวลาที่มารับบริการ opd ที่ไม่มีชื่ออยู่ในบัญชี 1(อ้างอิงจาก CID)";
        $sql = "SELECT
                    v.hn,v.cid, concat(p.pname,p.fname,'  ',p.lname) as pt_name ,
                    p.addrpart, p.moopart,th.addressid,th.full_name
              FROM vn_stat v
              LEFT OUTER JOIN patient p ON p.hn = v.hn
              LEFT OUTER JOIN thaiaddress th on th.addressid = concat(p.chwpart,p.amppart,p.tmbpart)
              WHERE
                   v.vstdate BETWEEN $datestart AND $dateend AND
                   v.cid NOT IN(SELECT cid FROM person) AND (p.death ='N' or p.death is NULL or p.death='  ') AND
                   p.nationality = '99' AND (p.cid not like '0%' and p.cid<>' ' and p.cid is not null and p.cid not like '111111111%')
              GROUP BY v.hn  
              ORDER BY th.addressid ";
            
        try {
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);


        return $this->render('report29', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'report_name' => $report_name,
                    'details' => $details,
        ]);
    }
    
   
}

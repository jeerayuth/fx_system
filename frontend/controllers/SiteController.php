<?php

namespace frontend\controllers;

use Yii;
use app\models\Opduser;

class SiteController extends \yii\web\Controller {

    public function actionIndex() {

        $report_name1 = "กราฟสรุปคนไข้ทะเบียนคลินิกเบาหวาน ไม่มีความดันร่วมภายใน อ.ละแม จ.ชุมพร";
        $report_name2 = "กราฟสรุปคนไข้ทะเบียนคลินิกเบาหวานที่มีความดันร่วมภายใน อ.ละแม จ.ชุมพร";
        $report_name3 = "กราฟสรุปคนไข้ทะเบียนคลินิกความดัน ภายใน อ.ละแม จ.ชุมพร";
        $report_name4 = "กราฟสรุปคนไข้ทะเบียนคลินิกถุงลมโป่งพอง ภายใน อ.ละแม จ.ชุมพร";
        $report_name5 = "กราฟสรุปคนไข้ทะเบียนคลินิกหอบหืด ภายใน อ.ละแม จ.ชุมพร";
        $report_name6 = "กราฟสรุปจำนวน visit คนไข้ OPD แยกรายเดือน ปีงบประมาณ 2560";
        $report_name7 = "กราฟสรุปจำนวนผู้มารับบริการผู้ป่วยใน (Ward+LR) แยกรายเดือน ปีงบประมาณ 2560";
        $report_name8 = "กราฟสรุปจำนวนรายงานสารสนเทศในระบบ HOSxP";


        // sql กราฟสรุปคนไข้ทะเบียนเบาหวาน ไม่มีความดันร่วม ภายใน อ.ละแม จ.ชุมพร
        $sql1 = "
                SELECT 
                th.addressid,th.name as tumbol , th.full_name as address,count(distinct(cm.hn)) as count_hn
                FROM clinicmember  cm
                LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
                LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
                LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
                LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
                WHERE 
                    cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
                AND 
                    cm.hn not in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))

                AND pd.code in('3','03')
                AND concat(pt.chwpart,pt.amppart) = '8605'
                GROUP BY th.addressid 
                ORDER BY count(distinct(cm.hn)) DESC  ";


        // sql กราฟสรุปคนไข้ทะเบียนคลินิกเบาหวานที่มีความดันร่วม ภายใน อ.ละแม จ.ชุมพร
        $sql2 = " SELECT 
                    th.addressid,th.name as tumbol , th.full_name as address,count(distinct(cm.hn)) as count_hn
                    FROM clinicmember  cm
                    LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
                    LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
                    LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
                    LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
                    WHERE 
                        cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='dm_clinic_code'))
                    AND 
                        cm.hn in(select hn from clinicmember where clinic=(select sys_value from sys_var where sys_name='ht_clinic_code'))

                    AND pd.code in('3','03')
                    AND concat(pt.chwpart,pt.amppart) = '8605'
                    GROUP BY th.addressid 
                    ORDER BY count(distinct(cm.hn)) DESC  ";


        // sql กราฟสรุปคนไข้ทะเบียนคลินิกความดัน ภายใน อ.ละแม จ.ชุมพร
        $sql3 = "SELECT 
                th.addressid,th.name as tumbol , th.full_name as address,count(distinct(cm.hn)) as count_hn
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
                AND concat(pt.chwpart,pt.amppart) = '8605'
                GROUP BY th.addressid 
                ORDER BY count(distinct(cm.hn)) DESC  ";


        // sql กราฟสรุปคนไข้ทะเบียนคลินิกถุงลมโป่งพอง ภายใน อ.ละแม จ.ชุมพร
        $sql4 = "SELECT 
                th.addressid,th.name as tumbol , th.full_name as address,count(distinct(cm.hn)) as count_hn
                FROM clinicmember  cm
                LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
                LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
                LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
                LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
                WHERE 
                    cm.clinic = '005'

                AND pd.code in('3','03')
                AND concat(pt.chwpart,pt.amppart) = '8605'
                GROUP BY th.addressid 
                ORDER BY count(distinct(cm.hn)) DESC  ";



        // sql กราฟสรุปคนไข้ทะเบียนคลินิกหอบหืด ภายใน อ.ละแม จ.ชุมพร
        $sql5 = "SELECT 
                th.addressid,th.name as tumbol , th.full_name as address,count(distinct(cm.hn)) as count_hn
                FROM clinicmember  cm
                LEFT OUTER JOIN clinic_member_status cs on cs.clinic_member_status_id=cm.clinic_member_status_id
                LEFT OUTER JOIN provis_typedis pd on pd.code=cs.provis_typedis
                LEFT OUTER JOIN patient pt ON pt.hn = cm.hn
                LEFT OUTER JOIN thaiaddress th ON th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
                WHERE 
                    cm.clinic = '019'

                AND pd.code in('3','03')
                AND concat(pt.chwpart,pt.amppart) = '8605'
                GROUP BY th.addressid 
                ORDER BY count(distinct(cm.hn)) DESC  ";



        // sql กราฟสรุปจำนวน visit คนไข้ OPD แยกรายเดือน ปีงบประมาณ 2559
        //$report_name6 = "กราฟสรุปจำนวนผู้มารับบริการผู้ป่วยนอก แยกรายเดือน ปีงบประมาณ 2559";
        $sql6 = "SELECT

        CONCAT(MONTH(v.vstdate),'-',YEAR(v.vstdate))  as vstmonth ,
        COUNT(v.vn) as count_vn_opd  

        FROM vn_stat v
        WHERE  v.vstdate BETWEEN '2016-10-01' AND '2017-09-30'
        GROUP BY  CONCAT(YEAR(v.vstdate),'-',MONTH(v.vstdate))
        ORDER BY  v.vstdate ";


        // sql กราฟสรุปจำนวน visit คนไข้ IPD แยกรายเดือน ปีงบประมาณ 2559
        //$report_name7 = "กราฟสรุปจำนวนผู้มารับบริการผู้ป่วยใน (Ward+LR) แยกรายเดือน ปีงบประมาณ 2559";
        $sql7 = "SELECT

                CONCAT(MONTH(a.dchdate),'-',YEAR(a.dchdate))  as group_date ,
                COUNT(a.an) as count_an_ipd 

                FROM an_stat a

                WHERE  a.dchdate BETWEEN '2016-10-01' AND '2017-09-30'

                group by  CONCAT(YEAR(a.dchdate),'-',MONTH(a.dchdate))

                order by a.dchdate ";

        // sql กราฟสรุปคนไข้ทะเบียนเบาหวาน ไม่มีความดันร่วม ภายใน อ.ละแม จ.ชุมพร
        $sql8 = "SELECT  
                    d.name,count(l.id) as count_report
                FROM lamaereports l
                    left outer join lamaedepartment d on d.id  = l.lamaedepartment_id
                WHERE status = 'enable'
                GROUP BY
                    l.lamaedepartment_id";

        try {
            $rawData1 = \yii::$app->db->createCommand($sql1)->queryAll();
            $rawData2 = \yii::$app->db->createCommand($sql2)->queryAll();
            $rawData3 = \yii::$app->db->createCommand($sql3)->queryAll();
            $rawData4 = \yii::$app->db->createCommand($sql4)->queryAll();
            $rawData5 = \yii::$app->db->createCommand($sql5)->queryAll();
            $rawData6 = \yii::$app->db->createCommand($sql6)->queryAll();
            $rawData7 = \yii::$app->db->createCommand($sql7)->queryAll();
            $rawData8 = \yii::$app->db->createCommand($sql8)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider1 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData1,
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


        $dataProvider5 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData5,
            'pagination' => FALSE,
        ]);

        $dataProvider6 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData6,
            'pagination' => FALSE,
        ]);

        $dataProvider7 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData7,
            'pagination' => FALSE,
        ]);

        $dataProvider8 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData8,
            'pagination' => FALSE,
        ]);


        return $this->render('index', [
                    'dataProvider1' => $dataProvider1,
                    'dataProvider2' => $dataProvider2,
                    'dataProvider3' => $dataProvider3,
                    'dataProvider4' => $dataProvider4,
                    'dataProvider5' => $dataProvider5,
                    'dataProvider6' => $dataProvider6,
                    'dataProvider7' => $dataProvider7,
                    'dataProvider8' => $dataProvider8,
                    'rawData1' => $rawData1,
                    'rawData2' => $rawData2,
                    'rawData3' => $rawData3,
                    'rawData4' => $rawData4,
                    'rawData5' => $rawData5,
                    'rawData6' => $rawData6,
                    'rawData7' => $rawData7,
                    'rawData8' => $rawData8,
                    'report_name1' => $report_name1,
                    'report_name2' => $report_name2,
                    'report_name3' => $report_name3,
                    'report_name4' => $report_name4,
                    'report_name5' => $report_name5,
                    'report_name6' => $report_name6,
                    'report_name7' => $report_name7,
                    'report_name8' => $report_name8,
        ]);
    }

    public function actionLogin() {
        return $this->render('login');
    }

    public function actionChklogin() {
        // step1. Prepare Where
        $attributes = array();

        // step2. Get Post Data
        $request = Yii::$app->request;
        $attributes["loginname"] = $request->post('username');
        $attributes["passweb"] = MD5($request->post('password'));

        // step3. Find One User in Database Table
        $user = Opduser::findOne($attributes);

        // step4 Check User in Database Table & Set Session
        if (!empty($user)) {
            $session = Yii::$app->session;
            $session->set('loginname', $user->loginname);
            $session->set('fullname', $user->getFullName());
            //  $session->set('picture', $user->getPicture());
            $this->redirect("index.php?r=site");
        } else {
            $this->redirect("index.php?r=site/login");
        }
    }

    public function actionLogout() {
        // clear session
        $session = Yii::$app->session;
        $session->remove('loginname');
        $session->remove('fullname');
        //  $session->remove('picture');
        $this->redirect("index.php?r=site");
    }

}

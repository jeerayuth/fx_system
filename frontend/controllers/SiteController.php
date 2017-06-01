<?php
namespace frontend\controllers;

use Yii;
use app\models\Opduser;

class SiteController extends \yii\web\Controller {

    public function actionIndex() {

        $report_name1 = "กราฟสรุปคนไข้ทะเบียนคลินิกเบาหวาน ไม่มีความดันร่วมภายใน อ.ละแม จ.ชุมพร";


        // sql กราฟสรุปคนไข้ทะเบียนเบาหวาน ไม่มีความดันร่วม ภายใน อ.ละแม จ.ชุมพร
         /*$sql1 = "
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
     
        try {
            $rawData1 = \yii::$app->db->createCommand($sql1)->queryAll();
           
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider1 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData1,
            'pagination' => FALSE,
        ]);

        */
        
        return $this->render('index', [                      
                    'report_name1' => $report_name1,                
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

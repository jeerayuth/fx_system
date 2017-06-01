<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opduser".
 *
 * @property string $loginname
 * @property string $name
 * @property string $password
 * @property string $passweb
 * @property string $accessright
 * @property string $department
 * @property string $departmentposition
 * @property string $entryposition
 * @property resource $picture
 * @property string $startfullscreen
 * @property string $doctorcode
 * @property integer $drug_access_level
 * @property string $groupname
 * @property string $visible_menu
 * @property string $viewallmenu
 * @property string $lab_staff
 * @property integer $hospital_department_id
 * @property string $nhso_user
 * @property string $nhso_password
 * @property integer $max_station
 * @property string $show_tip
 * @property string $password_expire_date
 * @property integer $password_recheck_date
 * @property string $new_password_date
 * @property string $check_lab_password
 * @property string $pcu_user
 * @property string $account_disable
 * @property string $restrict_ward_access
 * @property string $real_staff
 * @property string $restrict_clinic_access
 * @property string $no_lab_result_display
 * @property string $no_doctor_consult_display
 * @property string $no_announce_display
 * @property integer $announce_read_count
 * @property string $xray_staff
 * @property string $hos_guid
 * @property string $lab_check_password
 * @property string $cid
 * @property string $hos_guid_ext
 * @property integer $auto_logout_minute
 */
class Opduser extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'opduser';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['loginname'], 'required'],
            [['accessright', 'picture', 'visible_menu'], 'string'],
            [['drug_access_level', 'hospital_department_id', 'max_station', 'password_recheck_date', 'announce_read_count', 'auto_logout_minute'], 'integer'],
            [['password_expire_date', 'new_password_date'], 'safe'],
            [['loginname', 'name', 'password', 'passweb', 'department', 'departmentposition', 'entryposition', 'groupname', 'nhso_user', 'nhso_password'], 'string', 'max' => 250],
            [['startfullscreen', 'viewallmenu', 'lab_staff', 'show_tip', 'check_lab_password', 'pcu_user', 'account_disable', 'restrict_ward_access', 'real_staff', 'restrict_clinic_access', 'no_lab_result_display', 'no_doctor_consult_display', 'no_announce_display', 'xray_staff', 'lab_check_password'], 'string', 'max' => 1],
            [['doctorcode'], 'string', 'max' => 7],
            [['hos_guid'], 'string', 'max' => 38],
            [['cid'], 'string', 'max' => 13],
            [['hos_guid_ext'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'loginname' => 'Loginname',
            'name' => 'Name',
            'password' => 'Password',
            'passweb' => 'Passweb',
            'accessright' => 'Accessright',
            'department' => 'Department',
            'departmentposition' => 'Departmentposition',
            'entryposition' => 'Entryposition',
            'picture' => 'Picture',           
        ];
    }

    public function getFullName() {
         return $this->name;
    }
    
    public function getPicture() {
        return $this->picture;
    }

}

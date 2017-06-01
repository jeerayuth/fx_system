<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pttype".
 *
 * @property string $pttype
 * @property string $name
 */
class Pttype extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'pttype';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [   
            [['name'], 'string', 'max' => 255],
      
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'pttype' => 'รหัสสิทธิ์',
            'name' => 'ชื่อสิทธิ์',
                  
        ];
    }

    public function getFullName() {
         return $this->name;
    }
   

}

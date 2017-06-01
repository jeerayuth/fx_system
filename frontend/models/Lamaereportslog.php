<?php

namespace app\models;
use Yii;

/**
 * This is the model class for table "pttype".
 *
 * @property string $pttype
 * @property string $name
 */
class Lamaereportslog extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'lamaereportslog';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [   
            [['controller'], 'string', 'max' => 255],
      
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'controller' => 'หน่วยงาน',
                  
        ];
    }

    public function getFullName() {
         return $this->controller;
    }
   

}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pttype".
 *
 * @property string $pttype
 * @property string $name
 */
class Subcurrency extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'sub_currency';
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
            'id' => 'รหัส',
            'name' => 'สกุลเงิน',
                  
        ];
    }

    public function getFullName() {
         return $this->name;
    }
   

}

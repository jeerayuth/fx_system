<?php

namespace frontend\controllers;

use yii;
use yii\data\SqlDataProvider;

class ReportController extends \yii\web\Controller {

    public function actionIndex() {
        $session = Yii::$app->session;
        return $this->render('//report/index');
    }

    public function actionGrid($master_currency_id = null, $name = null) {

        if (!empty($master_currency_id)) {
            
            $dataProvider = new SqlDataProvider([
                'sql' => 'SELECT sc.*                  
                            FROM sub_currency sc '.  
                ' WHERE sc.master_currency_id=:master_currency_id ' ,
                'params' => [':master_currency_id' => $master_currency_id],
                'pagination' => [
                    'pageSize' => 200,
                ],
            ]);
            
         
            // returns an array of data rows
            $models = $dataProvider->getModels();
        }

        return $this->render('//report/grid', ['models' => $models, 'name' => $name]);
    }

    
    
  

}

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

    
    
    public function actionForm($controller = null, $form_id = null, $pointer = null, $report_name = null, $details = null) {
        //Function เลือก รูปแบบฟอร์มค้นหาข้อมูล
        $view = null;
        $point = null;
        $ctrl = null;
        $txt = null;
        


        switch ($form_id) {
            case "form1" :                  //รูปแบบฟอร์มค้นหาแบบที่ 1 แบบระหว่างวันที่
                $ctrl = $controller;
                $view = $form_id;
                $point = $pointer;
                $txt = $details;
                break;

            case "form2" :                  //รูปแบบฟอร์มค้นหาแบบที่ 2 แบบไม่มีวันที่
                $ctrl = $controller;
                $view = $form_id;
                $point = $pointer;
                $txt = $details;
                break;

            case "form3" :                  //รูปแบบฟอร์มค้นหาแบบที่ 3 แสดงวันที่ 
                $ctrl = $controller;
                $view = $form_id;
                $point = $pointer;
                $txt = $details;
                break;

            default:
                $ctrl = $controller;
                $view = $form_id;
                $point = $pointer;
                $txt = $details;
        }

        return $this->render($view, ['ctrl' => $ctrl, 'point' => $point, 'report_name' => $report_name, 'details' => $txt]);
    }

}

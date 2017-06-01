<?php

namespace frontend\components;
use app\models\Lamaereportslog;

use Yii;

class CommonController extends \yii\web\Controller {

    public function init() {
        parent::init();
    }

    // Public Funtion SaveLog
    public function SaveLog($dep_controller, $report, $username) {
      
        $model = new Lamaereportslog;
        $model->controller = $dep_controller;
        $model->report = $report;
        $model->username = $username;
        $model->viewlog = date("Y-m-d H:i:s");
        $model->save();
             
    }
    
    public function getSession() {
        $session = Yii::$app->session;    
        return $session->get('loginname');
    }

}

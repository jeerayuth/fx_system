<?php

namespace frontend\controllers;

use Yii;
use frontend\components\CommonController;

class JsonController extends CommonController {

    public function actionReport1($date_s='2017-01-01',$callback = null) {

         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSONP;
       // $callback = 'callback';
        $data = 
                    [
                    [1277078400000,244.04],
                    [1277164800000,242.88],
                    [1277251200000,240.78],
                    [1277337600000,237.31],
                    [1277424000000,236.10],
                    [1277683200000,235.80],
                    [1277769600000,226.90],
                    [1277856000000,222.25],
                ];

        return ['callback' => $callback, 'data' => $data];
    
    
    }

   

}

?>
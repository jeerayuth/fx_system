<?php

namespace frontend\controllers;

use Yii;
use frontend\components\CommonController;

class JsonController extends CommonController {

    public function actionReport1($date_s='2017-01-01',$callback = null) {

         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSONP;
      
        $data = (
                    [
                        ['00:00:00',244.04],
                        ['01:00:00',230.88],
                        ['02:00:00',240.78],
                        ['03:00:00',237.31],
                        ['04:00:00',236.10],
                        ['05:00:00',235.80],  
                        ['06:00:00',244.04],
                        ['07:00:00',230.88],
                        ['08:00:00',240.78],
                        ['09:00:00',237.31],
                        ['10:00:00',236.10],
                        ['11:00:00',235.80],
                        ['12:00:00',235.80],
                        ['13:00:00',230.88],
                        ['14:00:00',240.78],
                        ['15:00:00',237.31],
                        ['16:00:00',236.10],
                        ['17:00:00',235.80],  
                        ['18:00:00',244.04],
                        ['19:00:00',230.88],
                        ['20:00:00',240.78],
                        ['21:00:00',237.31],
                        ['22:00:00',236.10],
                        ['23:00:00',235.80],
 
                    ]
                
        
        );

        return ['callback' => $callback, 'data' => $data];
    
    
    }

   

}

?>
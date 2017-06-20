<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
use frontend\components\CommonController;
use yii\web\Response;

class JsonController extends CommonController {

    function actionJson1($date_s='2017-01-01',$callback = null) {
        // retrieve data to be returned
        $data = array(
            [
                [1276732800000,249.79],
                [1276819200000,249.76],
                [1277078400000,244.04],
                [1277164800000,242.88],
                [1277251200000,240.78],
                [1277337600000,237.31],
                [1277424000000,236.10],
                [1277683200000,235.80],
                [1277769600000,226.90],
                [1277856000000,222.25],
            ]
        );
        // set "fomat" property
        Yii::$app->getResponse()->format =
            (is_null($callback)) ?
                self::FORMAT_JSON : 
                self::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
            $data :
            array(
                'data'     => $data,
                'callback' => $callback
            );
    }
    
    
    
    public function actionReport1($date_s = '2017-01-01')
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSONP;
        $callback = 'callback';
        
        $data = array(
        
                [1276732800000,249.79],
                [1276819200000,249.76],
                [1277078400000,244.04],
                [1277164800000,242.88],
                [1277251200000,240.78],
                [1277337600000,237.31],
                [1277424000000,236.10],
                [1277683200000,235.80],
                [1277769600000,226.90],
                [1277856000000,222.25],
            
        );


        return ['callback' => $callback, 'data' => $data];
    }

    
    
    
    
    
    
    
    
}

?>
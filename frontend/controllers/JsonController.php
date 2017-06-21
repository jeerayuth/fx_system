<?php

namespace frontend\controllers;

use Yii;
use frontend\components\CommonController;


class JsonController extends CommonController {

    public function actionReport1($date_s = '2017-01-04' ,$callback = null) {

          \Yii::$app->response->format = \yii\web\Response::FORMAT_JSONP;
          
         $sql="select 

                h1.time_second as `time_second` , 

                IF(t1.`open` < t2.`OPEN`,t2.open-t1.open,
                                IF(t1.`open` > t2.`OPEN`, t2.open - t1.open, 0
                                                )
                )*1000 as `price_range`



                FROM price_dynamic_h1 h1

                LEFT JOIN (

                        select DATE_S ,TIME_S,`OPEN` from usdjpy_h1 where DATE_S = '$date_s'

                ) t1 on (t1.TIME_S = h1.time_first)

                LEFT JOIN (

                        select DATE_S,TIME_S,`OPEN` from usdjpy_h1 where DATE_S = '$date_s'

                ) t2 on (t2.TIME_S = h1.time_second) ";

          
         try {               
            $data = \yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        } 
     
        return ['callback' => $callback, 'data' => $data];
    
    
    }

   

}

?>
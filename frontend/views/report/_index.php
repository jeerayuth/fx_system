<?php
/* @var $this yii\web\View */

$this->title = 'หมวดหมู่หลัก';
$this->params['breadcrumbs'][] = $this->title;
?>

<table class="table table-hover">

    <thead>
        <tr>
            <th>หมวดหมู่ </th>
        </tr>
    </thead>

    <tbody>
        <tr>
          
            <td><span class="glyphicon glyphicon-zoom-in"></span> <a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'master_currency_id' => 'A', 'name' => 'AUD']) ?>">AUD</a></td>
        </tr>

        <tr>
           
            <td><span class="glyphicon glyphicon-zoom-in"></span> <a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'master_currency_id' => 'C', 'name' => 'CAD']) ?>">CAD</a></td>
        </tr>

        <tr>
           
            <td><span class="glyphicon glyphicon-zoom-in"></span> <a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'master_currency_id' => 'E', 'name' => 'EUR']) ?>">EUR</a></td>
        </tr>

        <tr>
          
            <td><span class="glyphicon glyphicon-zoom-in"></span> <a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'master_currency_id' => 'G', 'name' => 'GBP']) ?>">GBP</a></td>
        </tr>

        <tr>
          
            <td><span class="glyphicon glyphicon-zoom-in"></span> <a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'master_currency_id' => 'N', 'name' => 'NZD']) ?>">NZD</a></td>
        </tr>

        <tr>
         
            <td><span class="glyphicon glyphicon-zoom-in"></span> <a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'master_currency_id' => 'U', 'name' => 'USD']) ?>">USD</a></td>
        </tr>

        <tr>
          
            <td><span class="glyphicon glyphicon-zoom-in"></span> <a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'master_currency_id' => 'X', 'name' => 'XAU']) ?>">XAU</a></td>
        </tr>

    </tbody>

</table>
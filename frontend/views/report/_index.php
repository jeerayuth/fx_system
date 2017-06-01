<?php
/* @var $this yii\web\View */

$this->title = 'กลุ่มรายงานตามหน่วยงาน';
$this->params['breadcrumbs'][] = $this->title;
?>


<table class="table table-hover">

    <thead>
        <tr>
            <th>#</th>
            <th>หน่วยงาน </th>
        </tr>
    </thead>

    <tbody>
         <tr>
            <th scope="row">1</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 14, 'dep_name' => 'ประกันสุขภาพ']) ?>">ประกันสุขภาพ <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 1, 'dep_name' => 'เวชระเบียน']) ?>">เวชระเบียน <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 3, 'dep_name' => 'คลินิกเบาหวาน']) ?>">คลินิกเบาหวาน <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>

        <tr>
            <th scope="row">4</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 4, 'dep_name' => 'คลินิกความดันโลหิตสูง']) ?>">คลินิกความดันโลหิตสูง <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>

        <tr>
            <th scope="row">5</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 5, 'dep_name' => 'คลินิกถุงลมโป่งพอง']) ?>">คลินิกถุงลมโป่งพอง <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>

        <tr>
            <th scope="row">6</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 6, 'dep_name' => 'คลินิกหอบหืด']) ?>">คลินิกหอบหืด <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
        
        <tr>
            <th scope="row">7</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 7, 'dep_name' => 'อุบัติเหตุฉุกเฉิน']) ?>">อุบัติเหตุฉุกเฉิน <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
        
          <tr>
            <th scope="row">8</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 8, 'dep_name' => 'เภสัชกรรม']) ?>">เภสัชกรรม <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
        
           <tr>
            <th scope="row">9</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 10, 'dep_name' => 'ผู้ป่วยใน']) ?>">ผู้ป่วยใน <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
        
         <tr>
            <th scope="row">10</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 11, 'dep_name' => 'แพทย์แผนไทย']) ?>">แพทย์แผนไทย <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
        
         <tr>
            <th scope="row">11</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 13, 'dep_name' => 'กายภาพบำบัด']) ?>">กายภาพบำบัด <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
        
          <tr>
            <th scope="row">12</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 9, 'dep_name' => 'เวชปฏิบัติครอบครัว']) ?>">เวชปฏิบัติครอบครัว <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
        
         <tr>
            <th scope="row">13</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 15, 'dep_name' => 'คุ้มครองและป้องกันวัณโรค']) ?>">คุ้มครองและป้องกันวัณโรค <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
         <tr>
            <th scope="row">14</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 16, 'dep_name' => 'คลินิกฝากครรภ์']) ?>">คลินิกฝากครรภ์ <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
        
        <tr>
            <th scope="row">15</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 17, 'dep_name' => 'การเงิน']) ?>">การเงิน <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
		<tr>
            <th scope="row">16</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 18, 'dep_name' => 'คลินิก ARV']) ?>">คลินิก ARV <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
        
        <tr>
            <th scope="row">17</th>
            <td><a href="<?= Yii::$app->urlManager->createUrl(['report/grid', 'dep_id' => 19, 'dep_name' => 'X-Ray']) ?>">X-Ray <span class="glyphicon glyphicon-zoom-in"></span></a></td>
        </tr>
        
    </tbody>

</table>
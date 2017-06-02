<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>กรุณาระบุข้อมูลผู้ใช้งานเพื่อเข้าสู่ระบบ:</p>

    <div class="row">
        <div class="col-lg-5">
            <?= Html::beginForm(['site/chklogin'], 'post') ?>
            ชื่อผู้ใช้:
            <input type="text" class="form-control" name="username" />
            รหัสผ่าน:
            <input type="password" class="form-control" name="password" />

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>

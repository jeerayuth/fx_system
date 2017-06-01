<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\assets\MaterialAsset;

//AppAsset::register($this);
MaterialAsset::register($this);
$session = Yii::$app->session;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'ระบบศูนย์ข้อมูลและสารสนเทศ',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'หน้าแรก', 'url' => ['/site/index']],
            ];
            if ($session["loginname"] != null) {
                $menuItems[] = ['label' => 'กลุ่มรายงานตามหน่วยงาน', 'url' => ['/report/index']];
                $menuItems[] = ['label' => 'ออกจากระบบ', 'url' => ['/site/logout']];
            } else {
                $menuItems[] = ['label' => 'ลงชื่อเข้าใช้งาน', 'url' => ['/site/login']];
            }

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">


                <?=
                Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => Yii::t('yii', 'หน้าแรก'),
                        'url' => Yii::$app->homeUrl,
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>

                <?= Alert::widget() ?>
                <?= $content ?>
                <br/>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; ศูนย์ข้อมูลและสารสนเทศ โรงพยาบาลละแม <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

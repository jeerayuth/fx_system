<?php if (Yii::$app->session["loginname"] != null): ?>
    <?php echo $this->render("//compare/_index"); ?>
<?php else : ?>
    <?php echo $this->render("//site/login"); ?>
<?php endif; ?>

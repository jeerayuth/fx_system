<?php if (Yii::$app->session["loginname"] != null): ?>
    <?php echo $this->render("//report/_grid", ['models' => $models, 'name'=> $name]); ?>
<?php else : ?>
    <?php echo $this->render("//site/login"); ?>
<?php endif; ?>

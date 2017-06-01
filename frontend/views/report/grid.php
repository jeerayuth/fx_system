<?php if (Yii::$app->session["loginname"] != null): ?>
    <?php echo $this->render("//report/_grid", ['models' => $models, 'dep_name'=> $dep_name]); ?>
<?php else : ?>
    <?php echo $this->render("//site/login"); ?>
<?php endif; ?>

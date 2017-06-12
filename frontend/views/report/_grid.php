<?php
/* @var $this yii\web\View */
$this->title = $name;
$this->params['breadcrumbs'][] = ['label' => 'รายการคู่เงิน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>






<!-- start project list -->
<table class="table table-striped projects">
    <thead>
        <tr>
            <th style="width: 5%">ลำดับ</th>
            <th style="width: 95%">คู่เงิน</th>

        </tr>
    </thead>
    <tbody>
        <?php $count = 0; ?>
        <?php foreach ($models as $item) { ?>

            <tr>
                <td><?= $count = $count + 1; ?></td>
                <td>
                    <a href="index.php?r=sql/report1&sub_currency_id=<?= $item['id']; ?>"><?= $item['name']; ?></a>
                                                   
                </td>
                              
            </tr>

        <?php } ?>

    </tbody>
</table>
<!-- end project list -->


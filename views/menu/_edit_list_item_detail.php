<?php

use yii\helpers\Html;
use yii\helpers\VarDumper;
?>
    <li style="margin-bottom: 10px;">

        <?php
        $iconPath = Yii::getAlias('@web/foodItemsUploads/') . $model->image;
        ?>
        <img style="display: inline-block; object-fit: cover;" height='20' width="30" src='<?= $iconPath ?>'/>
        <label><?= Html::encode($model->title); ?></label>
        <div class="pull-right" style="margin-left: 5px;margin-right: 5px;">
            <?=
            Html::a('<span class="glyphicon glyphicon-edit"></span>', ["food-item/update", "id" => $model->id])
            ?>
        </div>
        <div class="pull-right" style="margin-left: 5px;margin-right: 5px;">
            <?=
            Html::a('<span class="glyphicon glyphicon-remove"></span>', ["food-item/delete", "id" => $model->id], [
                'data' => [
                    'confirm' => 'Are you sure ?',
                    'method' => 'post',
        ]])
            ?>
        </div>
    </li>


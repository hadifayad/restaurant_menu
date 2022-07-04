<?php

// _list_item.php


use app\models\FoodItem;
use app\models\FoodItemSearch;
use app\models\Users;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;
?>

<div style="margin-bottom: 20px;">
    <div class="panel panel-default">
        <div class="panel panel-heading" style="margin: 0px;">

            <?php
            $iconPath = Yii::getAlias('@web/categoriesUploads/') . $model->image;
            ?>
            <img style="display: inline-block; object-fit: cover;" height='30' width="80" src='<?= $iconPath ?>' />
            <label><?= Html::encode($model->name); ?></label>
            <div class="pull-right" style="margin-left: 5px;margin-right: 5px;">
                <?=
                Html::a('<span class="glyphicon glyphicon-plus"></span>', ["food-item/create", "category_id" => $model->id]
                        , [
                    'style' => "color: green;"
                        ]
                )
                ?>
            </div>
            <div class="pull-right" style="margin-left: 5px;margin-right: 5px;">
                <?=
                Html::a('<span class="glyphicon glyphicon-edit"></span>', ["food-category/update", "id" => $model->id]
                        , [
                    'style' => "color: blue;"
                        ]
                )
                ?>
            </div>
            <div class="pull-right" style="margin-left: 5px;margin-right: 5px;">
                <?=
                Html::a('<span class="glyphicon glyphicon-remove"></span>', ["food-category/delete", "id" => $model->id], [
                    'data' => [
                        'confirm' => 'Are you sure ?',
                        'method' => 'post',
                    ], 'style' => "color: red;"])
                ?>
            </div>
        </div>
        <div class="panel panel-body" style="margin: 0px;">
            <div style="margin-left: 0px;">

                <?php
                $searchModel = new FoodItemSearch();


                $query = FoodItem::find();
                $user = Users::findOne(["id" => Yii::$app->user->id]);
                $query = $query->andWhere(["category_id" => $model->id]);
                if ($user) {
                    $query = $query->andWhere(["restaurant_id" => $user->restaurant_id]);
                } else {
                    $query = $query->andWhere("0=1");
                }
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);

                echo '<ol>';
                echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'options' => [
                        'tag' => 'div',
                        'class' => 'list-wrapper',
                        'id' => 'list-wrapper',
                    ],
                    'layout' => "{items}",
                    'itemView' => '_edit_list_item_detail',
                ]);
                echo '</ol>';
                ?>


            </div>


        </div>
    </div>



</div>
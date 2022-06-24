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
            <img style="display: inline-block; object-fit: cover;" height='20' width="30" src='<?= $iconPath ?>'/>
            <label><?= Html::encode($model->name); ?></label>
            <div class="pull-right">
                <?=
                Html::a('<span class="glyphicon glyphicon-edit"></span>', ["food-category/update", "id" => $model->id])
                ?>
            </div>
        </div>
        <div class="panel panel-body" style="margin: 0px;">
            <div style="margin-left: 50px;">

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


                echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'options' => [
                        'tag' => 'div',
                        'class' => 'list-wrapper',
                        'id' => 'list-wrapper',
                    ],
                    'layout' => "{items}",
                    'itemView' => '_edit_list_item_detail',
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
////            'id',
//            'name',
//            [
//                'attribute' => 'image',
//                'format' => "raw",
//                'value' => function($model) {
//                    $iconPath = Yii::getAlias('@web/categoriesUploads/') . $model->image;
//                    return "<img  height='40' src='$iconPath'/>";
//                }
//            ],
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
                ]);
                ?>
            </div>


        </div>
    </div>



</div>
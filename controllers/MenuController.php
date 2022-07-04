<?php

namespace app\controllers;

use app\models\FoodCategory;
use app\models\FoodCategorySearch;
use app\models\FoodItem;
use app\models\Restaurant;
use yii\web\Controller;

class MenuController extends Controller {

    public function actionEdit() {


        $searchModel = new FoodCategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('edit', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {

        $categories = FoodCategory::find()->where(["restaurant_id" => $id])->asArray()->all();
        for ($i = 0; $i < sizeof($categories); $i++) {
            $categories[$i]["food"] = FoodItem::find()
                            ->select("food_item.* ,food_category.name as category")
                            ->join("join", "food_category", "food_category.id = food_item.category_id")
                            ->andWhere(['food_category.restaurant_id' => $id])
                            ->andWhere(['food_item.restaurant_id' => $id])
                            ->andWhere(['food_item.category_id' => $categories[$i]['id']])
                            ->asArray()->all();
        }

        $restuarant = Restaurant::findOne(["id" => $id]);
        if ($restuarant) {
            return $this->renderPartial('//site/our-menu', [
                        'food' => $categories,
                        'restuarant' => $restuarant,
            ]);
        }
    }

}

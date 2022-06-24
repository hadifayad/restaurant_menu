<?php

namespace app\controllers;

use app\models\FoodCategorySearch;
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

}

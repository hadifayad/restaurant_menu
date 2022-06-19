<?php

namespace app\controllers;

use app\models\FoodCategory;
use app\models\FoodCategorySearch;
use app\models\Users;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * FoodCategoryController implements the CRUD actions for FoodCategory model.
 */
class FoodCategoryController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
        return array_merge(
                parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
                ]
        );
    }

    /**
     * Lists all FoodCategory models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new FoodCategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FoodCategory model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FoodCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new FoodCategory();

        $user = Users::findOne(["id" => Yii::$app->user->id]);
        if ($user) {
            if ($user["restaurant_id"]) {
                $model->restaurant_id = $user["restaurant_id"];
            }
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                $file = $model->file;


                $user = Users::findOne(["id" => \Yii::$app->user->id]);

                $model->restaurant_id = $user->restaurant_id;

//                VarDumper::dump($model,3,true);
//                die();

                if ($model->save()) {
                    if ($model->uploadFile($file, $model->primaryKey)) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        
                    }
                } else {
                    VarDumper::dump($model->getErrors(), 3, true);
                    die();
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing FoodCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->file = UploadedFile::getInstance($model, 'file');
            $file = $model->file;


            if ($model->save()) {
                if ($file) {
                    $path = Yii::getAlias('@webroot/categoriesUploads/');
                    $filePath = $path . $model->image;
                    if (is_file($filePath) && file_exists($filePath)) {
                        unlink($filePath);
                    } else {
                        
                    }

                    if ($model->uploadFile($file, $model->primaryKey)) {
                        
                    } else {
                        
                    }
                }
            } else {
                VarDumper::dump($model->getErrors(), 3, true);
                die();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FoodCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $path = Yii::getAlias('@webroot/categoriesUploads/');
        $filePath = $path . $model->image;
        if (is_file($filePath) && file_exists($filePath)) {
            unlink($filePath);
        } else {
//                echo 'not directory';
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the FoodCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return FoodCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = FoodCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}

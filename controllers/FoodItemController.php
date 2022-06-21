<?php

namespace app\controllers;

use app\models\FoodItem;
use app\models\FoodItemSearch;
use app\models\Users;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * FoodItemController implements the CRUD actions for FoodItem model.
 */
class FoodItemController extends Controller {

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
     * Lists all FoodItem models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new FoodItemSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FoodItem model.
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
     * Creates a new FoodItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new FoodItem();

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

                if ($model->save()) {
                    if ($model->uploadFile($file, $model->primaryKey)) {

                        $modelNew = new FoodItem();
                        $modelNew->category_id = $model->category_id;
                        return $this->render('create', [
                                    'model' => $modelNew
                        ]);
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
     * Updates an existing FoodItem model.
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
                    $path = Yii::getAlias('@webroot/foodItemsUploads/');
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
     * Deletes an existing FoodItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $path = Yii::getAlias('@webroot/foodItemsUploads/');
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
     * Finds the FoodItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return FoodItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = FoodItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}

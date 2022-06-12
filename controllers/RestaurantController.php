<?php

namespace app\controllers;

use app\models\Restaurant;
use app\models\RestaurantImages;
use app\models\RestaurantPictures;
use app\models\RestaurantSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * RestaurantController implements the CRUD actions for Restaurant model.
 */
class RestaurantController extends Controller {

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
     * Lists all Restaurant models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RestaurantSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Restaurant model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {

        $restaurantPictures = RestaurantPictures::find()
                ->where(["restaurant_id" => $id])
                ->all();


        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'restaurantPictures' => $restaurantPictures,
        ]);
    }

    /**
     * Creates a new Restaurant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Restaurant();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->file = UploadedFile::getInstance($model, 'file');
                $file = $model->file;

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
     * Updates an existing Restaurant model.
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
                    $path = Yii::getAlias('@webroot/restaurantsUploads/');
                    $filePath = $path . $model->icon;
                    if (is_file($filePath) && file_exists($filePath)) {
                        unlink($filePath);
                    } else {
                        
                    }

                    if ($model->uploadFile($file, $model->primaryKey)) {
                        
                    } else {
                        
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Restaurant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {

        $model = $this->findModel($id);
        $path = Yii::getAlias('@webroot/restaurantsUploads/');
        $filePath = $path . $model->icon;
        if (is_file($filePath) && file_exists($filePath)) {
            unlink($filePath);
        } else {
//                echo 'not directory';
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Restaurant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Restaurant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Restaurant::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionAddImages($id) {
        $model = new RestaurantImages();

        if ($model->load($this->request->post())) {
            $model->file = UploadedFile::getInstances($model, 'file');
            $files = $model->file;
            if ($model->uploadFiles($files, $id)) {
                return $this->redirect(['view', 'id' => $id]);
            } else {
                
            }
        }
        return $this->render('add-images', [
                    'model' => $model,
        ]);
    }

    public function actionDeleteFile() {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $restaurantId = $request->post('restaurantId');
        $imageName = $request->post('imageName');

        $path = \Yii::getAlias('@webroot/restaurantsUploads/');
        $filePath = $path . $imageName;
        $myModel = RestaurantPictures::findOne(["id" => $restaurantId]);
        
//        VarDumper::dump($restaurantId,3,true);
//        VarDumper::dump($restaurantId,3,true);
//        VarDumper::dump($myModel,3,true);
//        die();
        if ($myModel) {
            $myModel->delete();
        }
        if (is_file($filePath) && file_exists($filePath)) {
            unlink($filePath);
        } else {
//                echo 'not directory';
        }

        return [
            'success' => true,
        ];
    }

}

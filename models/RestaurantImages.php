<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $userId
 * @property string $text
 * @property string $date
 *
 * @property NewsMedia[] $newsMedia
 * @property User $user
 * @property User $imageFile
 */
class RestaurantImages extends Model {

    public $file;

    public function rules() {
        return [
            [['file'], 'file', 'skipOnEmpty' => false,
                'extensions' => 'png, jpg',
                'maxFiles' => 5,
            ]
        ];
    }

    public function attributeLabels() {
        return [
            'file' => Yii::t('app', 'File'),
        ];
    }

    public function uploadFiles($files, $restaurantId) {
        if ($this->validate()) {
            foreach ($files as $file) {
                $randomString = Yii::$app->security->generateRandomString();
                $imageName = $randomString . '.' . $file->extension;
                $RestaurantPictures = new RestaurantPictures();
                $RestaurantPictures->image = $imageName;
                $RestaurantPictures->restaurant_id = $restaurantId;
                if ($RestaurantPictures->save()) {
                    
                } else {
                    VarDumper::dump($RestaurantPictures->getErrors(), 3, true);
                    die();
                }
                $file->saveAs('restaurantsUploads/' . $imageName);
            }
            return true;
        } else {
            return false;
        }
    }

}

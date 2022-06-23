<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "restaurant".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $open_time
 * @property string $close_time
 * @property string $address
 * @property string $phone1
 * @property string $phone2
 * @property string $phone3
 * @property string $icon
 * @property string $about_us
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string $location
 *
 * @property RestaurantPictures[] $restaurantPictures
 * @property User[] $users
 */
class Restaurant extends ActiveRecord {

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'restaurant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'description', 'open_time', 'close_time', 'address', 'phone1'], 'required'],
            [['description', 'address', 'about_us', 'facebook', 'instagram', 'location'], 'string'],
            [['name', 'open_time', 'close_time', 'phone1', 'phone2', 'phone3'], 'string', 'max' => 200],
            [['icon'], 'string', 'max' => 255],
            [['file'], 'file', 'skipOnEmpty' => true,
                'extensions' => 'png, jpg',
                'maxFiles' => 1,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'open_time' => Yii::t('app', 'Open Time'),
            'close_time' => Yii::t('app', 'Close Time'),
            'address' => Yii::t('app', 'Address'),
            'phone1' => Yii::t('app', 'Phone1'),
            'phone2' => Yii::t('app', 'Phone2'),
            'phone3' => Yii::t('app', 'Phone3'),
            'icon' => Yii::t('app', 'Icon'),
            'about_us' => Yii::t('app', 'About Us'),
            'facebook' => Yii::t('app', 'Facebook'),
            'instagram' => Yii::t('app', 'Instagram'),
            'location' => Yii::t('app', 'Location'),
        ];
    }

    /**
     * Gets query for [[RestaurantPictures]].
     *
     * @return ActiveQuery
     */
    public function getRestaurantPictures() {
        return $this->hasMany(RestaurantPictures::className(), ['restaurant_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return ActiveQuery
     */
    public function getUsers() {
        return $this->hasMany(User::className(), ['restaurant_id' => 'id']);
    }

//    public function uploadFiles($files, $restaurantId) {
//        if ($this->validate()) {
//            foreach ($files as $file) {
//                $randomString = Yii::$app->security->generateRandomString();
//                $imageName = $randomString . '.' . $file->extension;
//                $restaurant = Restaurant::findOne(["id" => $restaurantId]);
//                if ($restaurant) {
//                    $restaurant->icon = $imageName;
//                    if ($restaurant->save()) {
//                        $file->saveAs('restaurantsUploads/' . $imageName);
//                    } else {
//                        VarDumper::dump($restaurant->getErrors(), 3, true);
//                        die();
//                    }
//                } else {
//                    VarDumper::dump("restaurant does not exist", 3, true);
//                    die();
//                }
//                //need just one file/picture
//                return true;
//            }
//            return true;
//        } else {
//            return false;
//        }
//    }

    public function uploadFile($file, $restaurantId) {
        if ($this->validate()) {
            $randomString = Yii::$app->security->generateRandomString();
            $imageName = $randomString . '.' . $file->extension;
            $restaurant = Restaurant::findOne(["id" => $restaurantId]);
            if ($restaurant) {
                $restaurant->icon = $imageName;
                if ($restaurant->save()) {
                    $file->saveAs('restaurantsUploads/' . $imageName);
                } else {
                    VarDumper::dump($restaurant->getErrors(), 3, true);
                    die();
                }
            } else {
                VarDumper::dump("restaurant does not exist", 3, true);
                die();
            }
            //need just one file/picture
            return true;
        } else {
            return false;
        }
    }

    public function getFoodItems() {
        return $this->hasMany(FoodItem::className(), ['restaurant_id' => 'id']);
    }

}

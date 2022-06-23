<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "food_item".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $category_id
 * @property string $image
 * @property int $restaurant_id
 * @property int $price
 * @property Restaurant $restaurant 
 */
class FoodItem extends ActiveRecord {

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'food_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['title', 'description', 'category_id', 'image', 'restaurant_id', 'price'], 'required'],
            [['description'], 'string'],
            [['category_id', 'restaurant_id', 'price'], 'integer'],
            [['title', 'image'], 'string', 'max' => 200],
            [['restaurant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::className(), 'targetAttribute' => ['restaurant_id' => 'id']],
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
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'category_id' => Yii::t('app', 'Category'),
            'image' => Yii::t('app', 'Image'),
            'restaurant_id' => Yii::t('app', 'Restaurant'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    public function getRestaurant() {
        return $this->hasOne(Restaurant::className(), ['id' => 'restaurant_id']);
    }

    public function getCategory() {
        return $this->hasOne(FoodCategory::className(), ['id' => 'category_id']);
    }

    public function uploadFile($file, $foodItemId) {
        if ($this->validate()) {
            $randomString = Yii::$app->security->generateRandomString();
            $imageName = $randomString . '.' . $file->extension;
            $foodItem = FoodItem::findOne(["id" => $foodItemId]);
            if ($foodItem) {
                $foodItem->image = $imageName;
                if ($foodItem->save()) {
                    $file->saveAs('foodItemsUploads/' . $imageName);
                } else {
                    VarDumper::dump($foodItem->getErrors(), 3, true);
                    die();
                }
            } else {
                VarDumper::dump("food item does not exist", 3, true);
                die();
            }
            //need just one file/picture
            return true;
        } else {
            return false;
        }
    }

}

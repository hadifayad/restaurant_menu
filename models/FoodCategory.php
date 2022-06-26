<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "food_category".
 *
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property int $restaurant_id
 *
 * @property FoodItem[] $foodItems
 * @property User $restaurant
 */
class FoodCategory extends ActiveRecord {

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'food_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'restaurant_id'], 'required'],
            [['name', 'image'], 'string', 'max' => 200],
            [['restaurant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['restaurant_id' => 'restaurant_id']],
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
            'image' => Yii::t('app', 'Image'),
            'restaurant_id' => 'Restaurant',
        ];
    }

    public function uploadFile($file, $categoryId) {
        if ($file) {
            if ($this->validate()) {
                $randomString = Yii::$app->security->generateRandomString();
                $imageName = $randomString . '.' . $file->extension;
                $foodCategory = FoodCategory::findOne(["id" => $categoryId]);
                if ($foodCategory) {
                    $foodCategory->image = $imageName;
                    if ($foodCategory->save()) {
                        $file->saveAs('categoriesUploads/' . $imageName);
                    } else {
                        VarDumper::dump($foodCategory->getErrors(), 3, true);
                        die();
                    }
                } else {
                    VarDumper::dump("food category does not exist", 3, true);
                    die();
                }
                //need just one file/picture
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * Gets query for [[FoodItems]].
     *
     * @return ActiveQuery
     */
    public function getFoodItems() {
        return $this->hasMany(FoodItem::className(), ['category_id' => 'id']);
    }

    /**
     * Gets query for [[Restaurant]]. 
     * 
     * @return ActiveQuery 
     */
    public function getRestaurant() {
        return $this->hasOne(Users::className(), ['restaurant_id' => 'restaurant_id']);
    }

    public function getFoodItemsByUser() {


        $user = Users::findOne(["id" => \Yii::$app->user->id]);

        if ($user) {
            return FoodCategory::find()->where(["restaurant_id" => $user->restaurant_id])->all();
        }
        return [];
    }

}

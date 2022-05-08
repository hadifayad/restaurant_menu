<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "food_item".
 *
 * @property int $id
 * @property string $title
 * @property string $title_ar
 * @property string $description
 * @property string $description_ar
 * @property int $category_id
 * @property string $image
 * @property int $restaurant_id
 * @property int $price_lb
 * @property int|null $price_usd
 * @property int $price_unit
 */
class FoodItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'title_ar', 'description', 'description_ar', 'category_id', 'image', 'restaurant_id', 'price_lb', 'price_unit'], 'required'],
            [['description', 'description_ar'], 'string'],
            [['category_id', 'restaurant_id', 'price_lb', 'price_usd', 'price_unit'], 'integer'],
            [['title', 'title_ar', 'image'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'title_ar' => Yii::t('app', 'Title Ar'),
            'description' => Yii::t('app', 'Description'),
            'description_ar' => Yii::t('app', 'Description Ar'),
            'category_id' => Yii::t('app', 'Category ID'),
            'image' => Yii::t('app', 'Image'),
            'restaurant_id' => Yii::t('app', 'Restaurant ID'),
            'price_lb' => Yii::t('app', 'Price Lb'),
            'price_usd' => Yii::t('app', 'Price Usd'),
            'price_unit' => Yii::t('app', 'Price Unit'),
        ];
    }
}

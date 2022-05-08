<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "restaurant_pictures".
 *
 * @property int $id
 * @property string $image
 * @property int $restaurant_id
 *
 * @property Restaurant $restaurant
 */
class RestaurantPictures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restaurant_pictures';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'restaurant_id'], 'required'],
            [['restaurant_id'], 'integer'],
            [['image'], 'string', 'max' => 200],
            [['restaurant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::className(), 'targetAttribute' => ['restaurant_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
            'restaurant_id' => Yii::t('app', 'Restaurant ID'),
        ];
    }

    /**
     * Gets query for [[Restaurant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['id' => 'restaurant_id']);
    }
}

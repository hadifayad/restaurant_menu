<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "food_category".
 *
 * @property int $id
 * @property string $name
 * @property string $name_ar
 * @property string $image
 */
class FoodCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'name_ar', 'image'], 'required'],
            [['name', 'name_ar', 'image'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'name_ar' => Yii::t('app', 'Name Ar'),
            'image' => Yii::t('app', 'Image'),
        ];
    }
}

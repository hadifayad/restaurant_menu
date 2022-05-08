<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "restaurant".
 *
 * @property int $id
 * @property string $name
 * @property string $name_ar
 * @property string $description
 * @property string $description_ar
 * @property string $open_time
 * @property string $close_time
 * @property string $address
 * @property string $address_ar
 * @property string $phone1
 * @property string $phone2
 * @property string $phone3
 * @property string $icon
 * @property string $about_us
 * @property string $about_us_ar
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string $location
 *
 * @property RestaurantPictures[] $restaurantPictures
 * @property User[] $users
 */
class Restaurant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restaurant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'name_ar', 'description', 'description_ar', 'open_time', 'close_time', 'address', 'address_ar', 'phone1', 'phone2', 'phone3', 'icon', 'about_us', 'about_us_ar', 'location'], 'required'],
            [['description', 'description_ar', 'address', 'address_ar', 'about_us', 'about_us_ar', 'facebook', 'instagram', 'location'], 'string'],
            [['name', 'name_ar', 'open_time', 'close_time', 'phone1', 'phone2', 'phone3'], 'string', 'max' => 200],
            [['icon'], 'string', 'max' => 255],
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
            'description' => Yii::t('app', 'Description'),
            'description_ar' => Yii::t('app', 'Description Ar'),
            'open_time' => Yii::t('app', 'Open Time'),
            'close_time' => Yii::t('app', 'Close Time'),
            'address' => Yii::t('app', 'Address'),
            'address_ar' => Yii::t('app', 'Address Ar'),
            'phone1' => Yii::t('app', 'Phone1'),
            'phone2' => Yii::t('app', 'Phone2'),
            'phone3' => Yii::t('app', 'Phone3'),
            'icon' => Yii::t('app', 'Icon'),
            'about_us' => Yii::t('app', 'About Us'),
            'about_us_ar' => Yii::t('app', 'About Us Ar'),
            'facebook' => Yii::t('app', 'Facebook'),
            'instagram' => Yii::t('app', 'Instagram'),
            'location' => Yii::t('app', 'Location'),
        ];
    }

    /**
     * Gets query for [[RestaurantPictures]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurantPictures()
    {
        return $this->hasMany(RestaurantPictures::className(), ['restaurant_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['restaurant_id' => 'id']);
    }
}

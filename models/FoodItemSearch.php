<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FoodItem;

/**
 * FoodItemSearch represents the model behind the search form of `app\models\FoodItem`.
 */
class FoodItemSearch extends FoodItem {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'category_id', 'restaurant_id', 'price'], 'integer'],
            [['title', 'description', 'image'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = FoodItem::find();



        $user = Users::findOne(["id" => \Yii::$app->user->id]);

        if ($user) {
            $query = $query->where(["restaurant_id" => $user->restaurant_id]);
        } else {
            $query = $query->where("0=1");
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'restaurant_id' => $this->restaurant_id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }

}

<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FoodCategory;

/**
 * FoodCategorySearch represents the model behind the search form of `app\models\FoodCategory`.
 */
class FoodCategorySearch extends FoodCategory {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['name', 'name_ar', 'image'], 'safe'],
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
        $query = FoodCategory::find();

        $user = Users::findOne(["id" => \Yii::$app->user->id]);

        if ($user) {
            $query = $query->where(["restaurant_id" => $user->restaurant_id]);
        } else {
            $query = $query->where("0=1");
        }

//        \yii\helpers\VarDumper::dump($query, 3, true);
//        die();
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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'name_ar', $this->name_ar])
                ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }

}

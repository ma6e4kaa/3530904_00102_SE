<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Showplace;

/**
 * ShowplaceSearch represents the model behind the search form of `app\models\Showplace`.
 */
class ShowplaceSearch extends Showplace
{
    public $city;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['showplace', 'city'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Showplace::find()->joinWith('city');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'showplace' => [
                    'asc' => ['showplace' => SORT_ASC],
                    'desc' => ['showplace' => SORT_DESC],
                ],
                'city' => [
                    'asc' => ['city.city' => SORT_ASC],
                    'desc' => ['city.city' => SORT_DESC],
                ],
            ]
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

        $query->andFilterWhere(['like', 'showplace', $this->showplace])
                ->andFilterWhere(['like', 'city.city', $this->city]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SalesDetails;

/**
 * SalesDetailsSearch represents the model behind the search form of `app\models\SalesDetails`.
 */
class SalesDetailsSearch extends SalesDetails
{
    public $name;
    public $cost;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity'], 'integer'],
            [['name','cost'],'safe'],
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
        $query = SalesDetails::find()->joinWith('good');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'name' => [
                    'asc' => ['goods.name' => SORT_ASC],
                    'desc' => ['goods.name' => SORT_DESC],
                ],
                'cost' => [
                    'asc' => ['goods.cost' => SORT_ASC],
                    'desc' => ['goods.cost' => SORT_DESC],
                ],
                'quantity' => [
                    'asc' => ['quantity' => SORT_ASC],
                    'desc' => ['quantity' => SORT_DESC],
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
            'quantity' => $this->quantity,
        ]);
        
        $query->andFilterWhere(['like', 'goods.cost', $this->cost])
                ->andFilterWhere(['like', 'goods.name', $this->name]);

        return $dataProvider;
    }
    
    public function searchInTour($id, $params)
    {
        $query = SalesDetails::find()->innerJoin('sales','`sales`.`id` = `sales_details`.`sale_id`')->where(['ticket_id' => $id])->joinWith('good');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'name' => [
                    'asc' => ['goods.name' => SORT_ASC],
                    'desc' => ['goods.name' => SORT_DESC],
                ],
                'cost' => [
                    'asc' => ['goods.cost' => SORT_ASC],
                    'desc' => ['goods.cost' => SORT_DESC],
                ],
                'quantity' => [
                    'asc' => ['quantity' => SORT_ASC],
                    'desc' => ['quantity' => SORT_DESC],
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
            'quantity' => $this->quantity,
        ]);
        
        $query->andFilterWhere(['like', 'goods.cost', $this->cost])
                ->andFilterWhere(['like', 'goods.name', $this->name]);

        return $dataProvider;
    }
    
    public function searchInSales($id, $params)
    {
        $query = SalesDetails::find()->where(['sale_id' => $id])->joinWith('good');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'name' => [
                    'asc' => ['goods.name' => SORT_ASC],
                    'desc' => ['goods.name' => SORT_DESC],
                ],
                'cost' => [
                    'asc' => ['goods.cost' => SORT_ASC],
                    'desc' => ['goods.cost' => SORT_DESC],
                ],
                'quantity' => [
                    'asc' => ['quantity' => SORT_ASC],
                    'desc' => ['quantity' => SORT_DESC],
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
            'quantity' => $this->quantity,
        ]);
        
        $query->andFilterWhere(['like', 'goods.cost', $this->cost])
                ->andFilterWhere(['like', 'goods.name', $this->name]);

        return $dataProvider;
    }
}

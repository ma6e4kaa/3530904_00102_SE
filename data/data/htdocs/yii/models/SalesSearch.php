<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sales;

/**
 * SalesSearch represents the model behind the search form of `app\models\Sales`.
 */
class SalesSearch extends Sales
{
    public $username;
    public $name;
    public $date_tour;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'username', 'date_tour'], 'safe'],
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
        $query = Sales::find()->innerJoin('tickets','`tickets`.`id` = `sales`.`ticket_id`')->innerJoin('tour_date', '`tour_date`.`id` = `tickets`.`tour_date_id`')->innerJoin('tour', '`tour`.`id` = `tour_date`.`tour_id`')->innerJoin('user', '`user`.`id` = `tickets`.`guest_id`');
//->select('`sales`.*, SUM(`goods`.`cost` * `sales_details`.`quantity`) AS summa')->innerJoin('sales_details', '`sales_details`.`sale_id` = `sales`.`id`')->innerJoin('goods', '`goods`.`id` = `sales_details`.`good_id`')
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'name' => [
                    'asc' => ['tour.name' => SORT_ASC],
                    'desc' => ['tour.name' => SORT_DESC],
                ],
                'date_tour' => [
                    'asc' => ['tour_date.date_tour' => SORT_ASC],
                    'desc' => ['tour_date.date_tour' => SORT_DESC],
                ],
                'username' => [
                    'asc' => ['user.username' => SORT_ASC],
                    'desc' => ['user.username' => SORT_DESC],
                ],
//                'summ' => [
//                    'asc' => ['summa' => SORT_ASC],
//                    'desc' => ['summa' => SORT_DESC],
//                ],
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
        
        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'date_tour', $this->date_tour]);

        return $dataProvider;
    }
    
    public function searchMy($id, $params)
    {
        $query = Sales::find()->innerJoin('tickets','`tickets`.`id` = `sales`.`ticket_id`')
                ->innerJoin('tour_date', '`tour_date`.`id` = `tickets`.`tour_date_id`')
                ->innerJoin('tour', '`tour`.`id` = `tour_date`.`tour_id`')
                ->innerJoin('user', '`user`.`id` = `tickets`.`guest_id`')
                ->where(['`tickets`.`guest_id`' => $id]);
//->select('`sales`.*, SUM(`goods`.`cost` * `sales_details`.`quantity`) AS summa')->innerJoin('sales_details', '`sales_details`.`sale_id` = `sales`.`id`')->innerJoin('goods', '`goods`.`id` = `sales_details`.`good_id`')
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'name' => [
                    'asc' => ['tour.name' => SORT_ASC],
                    'desc' => ['tour.name' => SORT_DESC],
                ],
                'date_tour' => [
                    'asc' => ['tour_date.date_tour' => SORT_ASC],
                    'desc' => ['tour_date.date_tour' => SORT_DESC],
                ],
                'username' => [
                    'asc' => ['user.username' => SORT_ASC],
                    'desc' => ['user.username' => SORT_DESC],
                ],
//                'summ' => [
//                    'asc' => ['summa' => SORT_ASC],
//                    'desc' => ['summa' => SORT_DESC],
//                ],
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
        
        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'date_tour', $this->date_tour]);

        return $dataProvider;
    }
}

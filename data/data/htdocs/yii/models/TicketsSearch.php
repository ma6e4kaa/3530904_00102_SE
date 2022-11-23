<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tickets;

/**
 * TicketsSearch represents the model behind the search form of `app\models\Tickets`.
 */
class TicketsSearch extends Tickets
{
    public $name;
    public $date_tour;
    public $username;
    public $status;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'date_tour', 'username', 'status'], 'safe'],
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
        $query = Tickets::find()->innerJoin('user', '`user`.`id` = `tickets`.`guest_id`')
                ->innerJoin('tour_date', '`tour_date`.`id` = `tickets`.`tour_date_id`')
                ->innerJoin('tour', '`tour`.`id` = `tour_date`.`tour_id`')
                ->innerJoin('user_status', '`user_status`.`id` = `tickets`.`status`');

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
                'status' => [
                    'asc' => ['user_status.status' => SORT_ASC],
                    'desc' => ['user_status.status' => SORT_DESC],
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
        
        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'date_tour', $this->date_tour])
                ->andFilterWhere(['like', 'user_status.status', $this->status]);

        return $dataProvider;
    }
    
    public function searchMy($id, $params)
    {
        $query = Tickets::find()->innerJoin('user', '`user`.`id` = `tickets`.`guest_id`')
                ->innerJoin('tour_date', '`tour_date`.`id` = `tickets`.`tour_date_id`')
                ->innerJoin('tour', '`tour`.`id` = `tour_date`.`tour_id`')
                ->innerJoin('tour_status', '`tour_status`.`id` = `tickets`.`status`')
                ->where(['`tickets`.`guest_id`' => $id]);

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
                'status' => [
                    'asc' => ['user_status.status' => SORT_ASC],
                    'desc' => ['user_status.status' => SORT_DESC],
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
        
        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'date_tour', $this->date_tour])
                ->andFilterWhere(['like', 'user_status.status', $this->status]);

        return $dataProvider;
    }
}

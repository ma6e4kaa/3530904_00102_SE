<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Feedback;

/**
 * FeedbackSearch represents the model behind the search form of `app\models\Feedback`.
 */
class FeedbackSearch extends Feedback
{
    public $name;
    public $date_tour;
    public $username;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ball'], 'number'],
            [['feedback', 'name', 'username', 'date_tour'], 'safe'],
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
        $query = Feedback::find()->joinWith('tourDate')->joinWith('guest')->innerJoin('tour', '`tour`.`id` = `tour_date`.`tour_id`');

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
                'ball' => [
                    'asc' => ['ball' => SORT_ASC],
                    'desc' => ['ball' => SORT_DESC],
                ],
                'feedback' => [
                    'asc' => ['feedback' => SORT_ASC],
                    'desc' => ['feedback' => SORT_DESC],
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
            'ball' => $this->ball,
        ]);

        $query->andFilterWhere(['like', 'feedback', $this->feedback])
                ->andFilterWhere(['like', 'tour.name', $this->name])
                ->andFilterWhere(['like', 'tour_date.date_tour', $this->date_tour])
                ->andFilterWhere(['like', 'user.username', $this->username]);

        return $dataProvider;
    }
    
    public function searchInTour($id, $params)
    {
        $query = Feedback::find()->joinWith('tourDate')->joinWith('guest')->innerJoin('tour', '`tour`.`id` = `tour_date`.`tour_id`')->where(['`tour`.`id`' => $id]);

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
                'ball' => [
                    'asc' => ['ball' => SORT_ASC],
                    'desc' => ['ball' => SORT_DESC],
                ],
                'feedback' => [
                    'asc' => ['feedback' => SORT_ASC],
                    'desc' => ['feedback' => SORT_DESC],
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
            'ball' => $this->ball,
        ]);

        $query->andFilterWhere(['like', 'feedback', $this->feedback])
                ->andFilterWhere(['like', 'tour.name', $this->name])
                ->andFilterWhere(['like', 'tour_date.date_tour', $this->date_tour])
                ->andFilterWhere(['like', 'user.username', $this->username]);

        return $dataProvider;
    }
}

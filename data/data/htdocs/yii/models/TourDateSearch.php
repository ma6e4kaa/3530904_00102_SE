<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TourDate;

/**
 * TourDateSearch represents the model behind the search form of `app\models\TourDate`.
 */
class TourDateSearch extends TourDate
{
    public $tour_status;
    public $fio;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tour_id', 'seats'], 'integer'], //, 'status', 'guide'
            [['date_tour', 'fio', 'tour_status'], 'safe'],
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
    public function search($id, $params)
    {
        $query = TourDate::find()->joinWith('tour_status')->joinWith('user')->where(['tour_id' => $id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'tour_status' => [
                    'asc' => ['tour_status.tour_status' => SORT_ASC],
                    'desc' => ['tour_status.tour_status' => SORT_DESC],
                ],
                'date_tour' => [
                    'asc' => ['date_tour' => SORT_ASC],
                    'desc' => ['date_tour' => SORT_DESC],
                ],
                'seats' => [
                    'asc' => ['seats' => SORT_ASC],
                    'desc' => ['seats' => SORT_DESC],
                ],
                'fio' => [
                    'asc' => ['user.fio' => SORT_ASC],
                    'desc' => ['user.fio' => SORT_DESC],
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
            'tour_id' => $this->tour_id,
            'DATE(date_tour)' => $this->date_tour,
            'seats' => $this->seats,
//            'status' => $this->status,
//            'guide' => $this->guide,
        ]);
        
        $query->andFilterWhere(['like', 'tour_status', $this->tour_status]);
        $query->andFilterWhere(['like', 'fio', $this->fio]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TourStation;

/**
 * TourStationSearch represents the model behind the search form of `app\models\TourStation`.
 */
class TourStationSearch extends TourStation
{
    public $showplace;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tour_id'], 'integer'],
            [['time_stop', 'station', 'showplace'], 'safe'],
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
        $query = TourStation::find()->joinWith('showplace0')->where(['tour_id' => $id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'showplace' => [
                    'asc' => ['showplace.showplace' => SORT_ASC],
                    'desc' => ['showplace.showplace' => SORT_DESC],
                ],
                'time_stop' => [
                    'asc' => ['time_stop' => SORT_ASC],
                    'desc' => ['time_stop' => SORT_DESC],
                ],
                'station' => [
                    'asc' => ['station' => SORT_ASC],
                    'desc' => ['station' => SORT_DESC],
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
            'time_stop' => $this->time_stop,
        ]);
        $query->andFilterWhere(['like', 'showplace.showplace', $this->showplace]);
        $query->andFilterWhere(['like', 'station', $this->station])  ;

        return $dataProvider;
    }
}

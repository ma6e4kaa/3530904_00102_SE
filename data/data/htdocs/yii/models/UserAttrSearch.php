<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserAttr;

/**
 * UserAttrSearch represents the model behind the search form of `app\models\UserAttr`.
 */
class UserAttrSearch extends UserAttr
{
    public $username;
    public $role;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'seria', 'number'], 'integer'],
            [['fio', 'phone', 'email', 'issue_date', 'code', 'org', 'birthday', 'gender', 'birth_place', 'registr', 'username', 'role'], 'safe'],
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
        $query = UserAttr::find()->joinWith('user')->innerJoin('role','`role`.`id` = `user`.`role`');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'username' => [
                    'asc' => ['user.username' => SORT_ASC],
                    'desc' => ['user.username' => SORT_DESC],
                ],
                'role' => [
                    'asc' => ['role.role' => SORT_ASC],
                    'desc' => ['role.role' => SORT_DESC],
                ],
                'fio' => [
                    'asc' => ['fio' => SORT_ASC],
                    'desc' => ['fio' => SORT_DESC],
                ],
                'phone' => [
                    'asc' => ['phone' => SORT_ASC],
                    'desc' => ['phone' => SORT_DESC],
                ],
                'email' => [
                    'asc' => ['email' => SORT_ASC],
                    'desc' => ['email' => SORT_DESC],
                ],
                'birthday' => [
                    'asc' => ['birthday' => SORT_ASC],
                    'desc' => ['birthday' => SORT_DESC],
                ],
                'gender' => [
                    'asc' => ['gender' => SORT_ASC],
                    'desc' => ['gender' => SORT_DESC],
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
            'seria' => $this->seria,
            'number' => $this->number,
            'issue_date' => $this->issue_date,
            'birthday' => $this->birthday,
        ]);

        $query->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'user.username', $this->username])
            ->andFilterWhere(['like', 'role.role', $this->role])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'org', $this->org])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'birth_place', $this->birth_place])
            ->andFilterWhere(['like', 'registr', $this->registr]);

        return $dataProvider;
    }
}
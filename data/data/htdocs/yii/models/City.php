<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%city}}".
 *
 * @property int $id
 * @property string $city Город
 *
 * @property Showplace[] $showplaces
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city'], 'required'],
            [['city'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'city' => Yii::t('app', 'Город'),
        ];
    }

    /**
     * Gets query for [[Showplaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShowplaces()
    {
        return $this->hasMany(Showplace::class, ['city_id' => 'id']);
    }
}

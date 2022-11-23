<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%showplace}}".
 *
 * @property int $id
 * @property string $showplace Достопримечательность
 * @property int $city_id Город
 *
 * @property City $city
 * @property TourStation[] $tourStations
 */
class Showplace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%showplace}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['showplace', 'city_id'], 'required'],
            [['city_id'], 'integer'],
            [['showplace'], 'string', 'max' => 150],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'showplace' => Yii::t('app', 'Достопримечательность'),
            'city_id' => Yii::t('app', 'Город'),
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * Gets query for [[TourStations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTourStations()
    {
        return $this->hasMany(TourStation::class, ['showplace' => 'id']);
    }
}

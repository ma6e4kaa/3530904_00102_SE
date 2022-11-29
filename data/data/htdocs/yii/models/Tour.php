<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tour}}".
 *
 * @property int $id
 * @property string $name Название
 * @property string $start_time Время начала
 * @property string $end_time Время окончания
 * @property int $price Цена
 *
 * @property TourDate[] $tourDates
 * @property TourStation[] $tourStations
 */
class Tour extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tour}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'start_time', 'end_time', 'price'], 'required'],
            [['start_time', 'end_time'], 'safe'],
            [['price'], 'integer'],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Название'),
            'start_time' => Yii::t('app', 'Время начала'),
            'end_time' => Yii::t('app', 'Время окончания'),
            'price' => Yii::t('app', 'Цена'),
        ];
    }

    /**
     * Gets query for [[TourDates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTourDates()
    {
        return $this->hasMany(TourDate::class, ['tour_id' => 'id']);
    }

    /**
     * Gets query for [[TourStations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTourStations()
    {
        return $this->hasMany(TourStation::class, ['tour_id' => 'id']);
    }
}

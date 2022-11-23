<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tour_station}}".
 *
 * @property int $id
 * @property int $tour_id Тур
 * @property string $time_stop Время остановки
 * @property int|null $showplace Достопримечательность
 * @property string|null $station Описание
 *
 * @property Showplace $showplace0
 * @property Tour $tour
 */
class TourStation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tour_station}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_id', 'time_stop'], 'required'],
            [['tour_id', 'showplace'], 'integer'],
            [['time_stop'], 'safe'],
            [['station'], 'string', 'max' => 250],
            [['showplace'], 'exist', 'skipOnError' => true, 'targetClass' => Showplace::class, 'targetAttribute' => ['showplace' => 'id']],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::class, 'targetAttribute' => ['tour_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tour_id' => Yii::t('app', 'Тур'),
            'time_stop' => Yii::t('app', 'Время остановки'),
            'showplace' => Yii::t('app', 'Достопримечательность'),
            'station' => Yii::t('app', 'Описание'),
        ];
    }

    /**
     * Gets query for [[Showplace0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShowplace0()
    {
        return $this->hasOne(Showplace::class, ['id' => 'showplace']);
    }

    /**
     * Gets query for [[Tour]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::class, ['id' => 'tour_id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%feedback}}".
 *
 * @property int $id
 * @property int $tour_date_id Дата тура
 * @property int $guest_id Гость
 * @property float $ball Оценка
 * @property string|null $feedback Отзыв
 *
 * @property User $guest
 * @property TourDate $tourDate
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%feedback}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_date_id', 'guest_id', 'ball'], 'required'],
            [['tour_date_id', 'guest_id'], 'integer'],
            [['ball'], 'number'],
            [['feedback'], 'string', 'max' => 500],
            [['tour_date_id'], 'exist', 'skipOnError' => true, 'targetClass' => TourDate::class, 'targetAttribute' => ['tour_date_id' => 'id']],
            [['guest_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['guest_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tour_date_id' => Yii::t('app', 'Дата тура'),
            'guest_id' => Yii::t('app', 'Гость'),
            'ball' => Yii::t('app', 'Оценка'),
            'feedback' => Yii::t('app', 'Отзыв'),
        ];
    }

    /**
     * Gets query for [[Guest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGuest()
    {
        return $this->hasOne(User::class, ['id' => 'guest_id']);
    }

    /**
     * Gets query for [[TourDate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTourDate()
    {
        return $this->hasOne(TourDate::class, ['id' => 'tour_date_id']);
    }
}

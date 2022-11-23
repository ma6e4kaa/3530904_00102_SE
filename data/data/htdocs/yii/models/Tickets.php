<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tickets}}".
 *
 * @property int $id
 * @property int $tour_date_id Дата тура
 * @property int $guest_id Гость
 * @property int $status Статус билета
 *
 * @property User $guest
 * @property Sales[] $sales
 * @property UserStatus $status0
 * @property TourDate $tourDate
 */
class Tickets extends \yii\db\ActiveRecord
{
    public $tour_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tickets}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_date_id', 'guest_id', 'status'], 'required'],
            [['tour_date_id', 'guest_id', 'status'], 'integer'],
            [['tour_date_id'], 'exist', 'skipOnError' => true, 'targetClass' => TourDate::class, 'targetAttribute' => ['tour_date_id' => 'id']],
            [['guest_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['guest_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => UserStatus::class, 'targetAttribute' => ['status' => 'id']],
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
            'tour_id' => Yii::t('app', 'Тур'),
            'guest_id' => Yii::t('app', 'Гость'),
            'status' => Yii::t('app', 'Статус билета'),
            'status0.status' => Yii::t('app', 'Статус билета'),
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
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::class, ['ticket_id' => 'id']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(UserStatus::class, ['id' => 'status']);
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

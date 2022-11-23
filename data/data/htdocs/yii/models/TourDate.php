<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tour_date}}".
 *
 * @property int $id
 * @property int $tour_id Тур
 * @property string $date_tour Дата
 * @property int $seats Места
 * @property int $status Статус
 * @property int|null $guide Экскурсовод
 *
 * @property Feedback[] $feedbacks
 * @property User $guide0
 * @property TourStatus $status0
 * @property Tickets[] $tickets
 * @property Tour $tour
 */
class TourDate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tour_date}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_id', 'date_tour', 'seats', 'status'], 'required'],
            [['tour_id', 'seats', 'status', 'guide'], 'integer'],
            [['date_tour'], 'safe'],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::class, 'targetAttribute' => ['tour_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => TourStatus::class, 'targetAttribute' => ['status' => 'id']],
            [['guide'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['guide' => 'id']],
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
            'date_tour' => Yii::t('app', 'Дата'),
            'seats' => Yii::t('app', 'Места'),
            'status' => Yii::t('app', 'Статус'),
            'guide' => Yii::t('app', 'Экскурсовод'),
        ];
    }

    /**
     * Gets query for [[Feedbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::class, ['tour_date_id' => 'id']);
    }

    /**
     * Gets query for [[Guide0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserAttr::class, ['user_id' => 'guide']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTour_status()
    {
        return $this->hasOne(TourStatus::class, ['id' => 'status']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::class, ['tour_date_id' => 'id']);
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

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tour_status}}".
 *
 * @property int $id
 * @property string $tour_status Статус
 *
 * @property TourDate[] $tourDates
 */
class TourStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tour_status}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_status'], 'required'],
            [['tour_status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tour_status' => Yii::t('app', 'Статус'),
        ];
    }

    /**
     * Gets query for [[TourDates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTourDates()
    {
        return $this->hasMany(TourDate::class, ['status' => 'id']);
    }
}

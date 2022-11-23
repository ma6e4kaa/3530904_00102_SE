<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tags}}".
 *
 * @property int $id
 * @property string $tag Тэг
 *
 * @property TourTag[] $tourTags
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tags}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tag'], 'required'],
            [['tag'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tag' => Yii::t('app', 'Тэг'),
        ];
    }

    /**
     * Gets query for [[TourTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTourTags()
    {
        return $this->hasMany(TourTag::class, ['tag_id' => 'id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sales_details}}".
 *
 * @property int $id
 * @property int $sale_id Продажа
 * @property int $good_id Товар
 * @property int $quantity Кол-во
 *
 * @property Goods $good
 * @property Sales $sale
 */
class SalesDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sales_details}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_id', 'good_id', 'quantity'], 'required'],
            [['sale_id', 'good_id', 'quantity'], 'integer'],
            [['good_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::class, 'targetAttribute' => ['good_id' => 'id']],
            [['sale_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::class, 'targetAttribute' => ['sale_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sale_id' => Yii::t('app', 'Продажа'),
            'good_id' => Yii::t('app', 'Товар'),
            'quantity' => Yii::t('app', 'Кол-во'),
        ];
    }

    /**
     * Gets query for [[Good]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGood()
    {
        return $this->hasOne(Goods::class, ['id' => 'good_id']);
    }

    /**
     * Gets query for [[Sale]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSale()
    {
        return $this->hasOne(Sales::class, ['id' => 'sale_id']);
    }
}

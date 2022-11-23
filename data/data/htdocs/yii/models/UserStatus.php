<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_status}}".
 *
 * @property int $id
 * @property string $status
 */
class UserStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_status}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status' => Yii::t('app', 'Статус пользователя'),
        ];
    }
}

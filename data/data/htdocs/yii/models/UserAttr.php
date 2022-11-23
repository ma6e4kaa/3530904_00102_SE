<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_attr".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $fio ФИО
 * @property string|null $phone Телефон
 * @property string|null $email Почта
 *
 * @property User $user
 */
class UserAttr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_attr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio'], 'string', 'max' => 200],
//            [['fio'], 'match', 'pattern' => '/^[а-Я]|[а-Я]|[а-Я]$/', 'message' => 'Некорректное ФИО!'],
            [['phone'], 'match', 'pattern' => '/^\+7\([0-9]{3}\)\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/', 'message' => 'Некорректный номер телефона!'],
            [['email'], 'email', 'message'=>'Некорректный адрес электронной почты!'],
            [['user_id', 'seria', 'number'], 'integer'],
            [['issue_date', 'birthday'], 'safe'],
            [['code'], 'string', 'max' => 7],
            [['org', 'birth_place'], 'string', 'max' => 150],
            [['gender'], 'string', 'max' => 1],
            [['registr'], 'string', 'max' => 250],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fio' => Yii::t('app', 'ФИО'),
            'phone' => Yii::t('app', 'Телефон'),
            'email' => Yii::t('app', 'Почта'),
            'seria' => Yii::t('app', 'Серия'),
            'number' => Yii::t('app', 'Номер'),
            'issue_date' => Yii::t('app', 'Дата выдачи'),
            'code' => Yii::t('app', 'Код подразделения'),
            'org' => Yii::t('app', 'Кем выдан'),
            'birthday' => Yii::t('app', 'Дата рождения'),
            'gender' => Yii::t('app', 'Пол'),
            'birth_place' => Yii::t('app', 'Место рождения'),
            'registr' => Yii::t('app', 'Регистрация'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    
    public function getRole()
    {
        $user = $this->hasOne(User::class, ['id' => 'user_id']);
        return $user->getRole();
    }
}

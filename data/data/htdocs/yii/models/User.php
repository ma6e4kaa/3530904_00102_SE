<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username Логин
 * @property string $password Пароль
 * @property int|null $role Роль
 * @property int|null $auth_key
 * @property int|null $access_token
 *
 * @property Role $role0
 * @property UserAttr[] $userAttrs
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $passwd;
    public $old_passwd;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role'], 'integer'],
            [['username'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['password', 'auth_key', 'access_token'], 'string', 'max' => 250],
//            [['role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Логин'),
            'password' => Yii::t('app', 'Пароль'),
            'role' => Yii::t('app', 'Роль'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'access_token' => Yii::t('app', 'Access Token'),
        ];
    }

    /**
     * Gets query for [[Role0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role']);
    }
    
    public function getRole1()
    {
        return $this->hasOne(Role::class, ['id' => 'role']);
    }

    /**
     * Gets query for [[UserAttrs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserAttrs()
    {
        return $this->hasMany(UserAttr::class, ['user_id' => 'id']);
    }

    public function getAuthKey() {
        return $this->auth_key;
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($auth_key) {
        return $this->auth_key === $auth_key;
    }

    public static function findIdentity($id) {
        $search = (new UserSearch())->findIdentity($id);
        if ($search) {
            return $search;
        } else {
            return null;
        }
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        $search = (new UserSearch())->findIdentityByAccessToken($token);
        if ($search) {
            return $search;
        }

        return null;
    }
    
    public static function findByUsername($username)
    {
        $search = (new UserSearch())->findByUsername($username);
        if ($search) {
            return $search;
        }

        return null;
    }
    
    public function validatePassword($password)
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

}

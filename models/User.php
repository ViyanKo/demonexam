<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $full_name
 * @property string $phone
 * @property string $email
 * @property int $admin
 *
 * @property App[] $apps
 */
class User extends \yii\db\ActiveRecord Implements IdentityInterface
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['admin'], 'default', 'value' => 0],
            [['username', 'password', 'full_name', 'phone', 'email'], 'required'],
            [['admin'], 'integer'],
            [['username', 'password', 'full_name', 'phone', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'full_name' => 'Full Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'admin' => 'Admin',
        ];
    }

    /**
     * Gets query for [[Apps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApps()
    {
        return $this->hasMany(App::class, ['user_id' => 'id']);
    }

    // кусьминова IdentityInterface
    public static function findIdentity($id)

    {
        return static::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null)

    {
        return static::findOne(['access_token' => $token]);
    }


    public function getId()

    {
        return $this->id;
    }


    public function getAuthKey()

    {

    }


    public function validateAuthKey($authKey)

    {

    }    

    //кусьминова 

    
    //Найти пользователя по имени
     public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    //Валидация пароля
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

}

<?php

namespace app\models;

use app\models\base\UserBase;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class User extends UserBase implements \yii\web\IdentityInterface
{
    const ROLE_ADMINISTRATOR = 1;
    const ROLE_EMPLOYEE = 2;

    const ROLE_ADMINISTRATOR_LABEL = 'Администратор';
    const ROLE_EMPLOYEE_LABEL = 'Служител';

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const STATUS_ACTIVE_LABEL = 'Активен';
    const STATUS_INACTIVE_LABEL = 'Неактивен';

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
      return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function beforeSave($insert)
    {
        if($insert || $this->isAttributeChanged('password'))
        {
            $this->password = \Yii::$app->security->generatePasswordHash($this->password);
        }

        return parent::beforeSave($insert);
    }

    public static function getStatusArr()
    {
        return [
            self::STATUS_INACTIVE => self::STATUS_INACTIVE_LABEL,
            self::STATUS_ACTIVE => self::STATUS_ACTIVE_LABEL,
        ];
    }

    public static function getRoleArr()
    {
        return [
            self::ROLE_ADMINISTRATOR => self::ROLE_ADMINISTRATOR_LABEL,
            self::ROLE_EMPLOYEE => self::ROLE_EMPLOYEE_LABEL,
        ];
    }
}

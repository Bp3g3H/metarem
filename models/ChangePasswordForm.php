<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/14/2018
 * Time: 10:52 PM
 */

namespace app\models;


use yii\base\Model;

class ChangePasswordForm extends Model
{
    public $user_id;
    public $newPassword;
    public $repeatPassword;
    public $password;

    public function rules()
    {
        return  [
            [['newPassword','repeatPassword', 'password'], 'required', 'message' => 'Това поле е задължително'],
            ['repeatPassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => 'Паролата трябва да е еднаква']
        ];
    }

    public function __construct($id)
    {
        $this->user_id = $id;
    }

    public function getUser()
    {
        $user = User::findOne($this->user_id);
        if($user && \Yii::$app->getSecurity()->validatePassword($this->password, $user->password))
        {
            return $user;
        }

        return null;
    }


    public function changePassword()
    {
        $user = $this->getUser();

        if($user)
        {
            $user->password = $this->newPassword;
            return $user->save();
        }
        else
            $this->addError('password', 'Паролата не съвпада');

        return false;
    }
}
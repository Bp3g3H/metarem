<?php

namespace app\models\web;

use \yii\web\User;
class WebUser extends User
{
    public function getUserModel()
    {
        /** @var \app\models\User $user */
        return \app\models\User::findOne(['id' => $this->getId()]);
    }

    public function inRole($role)
    {
        $user = $this->getUserModel();
        if ($user != null)
            return $user->role == $role;
        return false;
    }
}
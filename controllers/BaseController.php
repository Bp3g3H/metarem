<?php

namespace app\controllers;

use yii\filters\AccessControl;
use Yii;

class BaseController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => [$this, 'accessRules']
                    ],
                ],
            ],
        ];
    }

    /**
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function accessRules($rule, $action)
    {
        return !Yii::$app->user->isGuest;
    }
}
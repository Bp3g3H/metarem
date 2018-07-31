<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/24/2018
 * Time: 10:04 PM
 */

namespace app\models;


use app\models\base\MaterialBase;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Material extends MaterialBase
{
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
}
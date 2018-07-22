<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.7.2018 г.
 * Time: 20:53 ч.
 */

namespace app\models;


use app\models\base\FirmBase;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Firm extends FirmBase
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
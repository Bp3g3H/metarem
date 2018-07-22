<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.7.2018 г.
 * Time: 20:54 ч.
 */

namespace app\models;


use app\models\base\OrderBase;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Order extends OrderBase
{
    const STATUS_PENDING = 1;
    const STATUS_DONE = 2;

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

    public static function create($firm_id)
    {
        $model = new Order();
        $model->firm_id = $firm_id;
        $model->status = self::STATUS_PENDING;

        if($model->save())
            return $model;
        else
            return false;
    }

}
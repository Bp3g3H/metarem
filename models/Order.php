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
    const EXPORT_PROTOCOL = 1;
    const EXPORT_OFFER = 0;

    const STATUS_NEW = 0;
    const STATUS_PENDING = 1;
    const STATUS_DONE = 2;

    const STATUS_NEW_LABEL = 'Нова';
    const STATUS_PENDING_LABEL = 'Изчакване';
    const STATUS_DONE_LABEL = 'Завършена';

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
        $model->status = self::STATUS_NEW;

        if($model->save())
            return $model;
        else
            return false;
    }

    public function getStatusLabel()
    {
        switch ($this->status)
        {
            case self::STATUS_NEW:
                return 'Нова';
            case self::STATUS_PENDING:
                return 'Изчакване';
            case self::STATUS_DONE:
                return 'Завършена';
            default:
                return null;
        }
    }

    public static function getStatusArray()
    {
        return [
            self::STATUS_NEW => self::STATUS_NEW_LABEL,
            self::STATUS_PENDING => self::STATUS_PENDING_LABEL,
            self::STATUS_DONE => self::STATUS_DONE_LABEL,
        ];
    }
}
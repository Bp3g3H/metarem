<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.7.2018 г.
 * Time: 20:55 ч.
 */

namespace app\models;


use app\models\base\ProductBase;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class Product extends ProductBase
{
    const LASER_CUTTING = 0;
    const ENGRAVING = 1;
    const PUNCHING = 2;
    const BENDING = 3;

    const LASER_CUTTING_STRING = 'Лазерно рязане';
    const ENGRAVING_STRING = 'Гравиране';
    const PUNCHING_STRING = 'Щанцоване';
    const BENDING_STRING = 'Огъване';


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

    public function beforeSave($insert)
    {
        $this->price_for_cutting = $this->price * $this->quantity;
        $this->full_weight = $this->weight * $this->quantity;
        $this->single_price_with_material = $this->price + ($this->weight * $this->material->price);
        $this->full_price = $this->single_price_with_material * $this->quantity;
        $this->price_with_dds = $this->full_price * 1.2;

        return parent::beforeSave($insert);
    }

    public static function getServices()
    {
        return [
            self::LASER_CUTTING => self::LASER_CUTTING_STRING,
            self::ENGRAVING => self::ENGRAVING_STRING,
            self::PUNCHING => self::PUNCHING_STRING,
            self::BENDING => self::BENDING_STRING,
        ];
    }
}
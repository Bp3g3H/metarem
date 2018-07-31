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

class Product extends ProductBase
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

    public function beforeSave($insert)
    {
        if($insert)
        {

        }

        $this->price_for_cutting = $this->price * $this->quantity;
        $this->full_weight = $this->weight * $this->quantity;
        $this->single_price_with_material = $this->price + ($this->weight * $this->material->price);
        $this->full_price = $this->single_price_with_material * $this->quantity;
        $this->price_with_dds = $this->full_price * 1.2;

        return parent::beforeSave($insert);
    }
}
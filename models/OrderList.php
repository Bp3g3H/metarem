<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.7.2018 г.
 * Time: 20:55 ч.
 */

namespace app\models;


use app\models\base\OrderListBase;

class OrderList extends OrderListBase
{
    public static function create($order_id, $product_id)
    {
        $model = new OrderList();
        $model->order_id = $order_id;
        $model->product_id = $product_id;

        if($model->save())
            return $model;
        else
            return false;
    }
}
<?php

namespace app\models\base;

use Yii;
use app\models\Order;
use app\models\Product;

/**
 * This is the model class for table "firm".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $phone_number
 * @property string $city
 * @property string $owner_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Order[] $orders
 * @property Product[] $products
 */
class FirmBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'firm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email', 'address', 'city', 'owner_name'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
            'city' => 'City',
            'owner_name' => 'Owner Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['firm_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['firm_id' => 'id']);
    }
}

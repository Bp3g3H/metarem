<?php

namespace app\models\base;

use Yii;
use app\models\OrderList;
use app\models\Order;
use app\models\Firm;
use app\models\Material;
/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $firm_id
 * @property string $product_name
 * @property int $quantity
 * @property int $material_id
 * @property string $price
 * @property string $weight
 * @property string $price_for_cutting
 * @property string $full_weight
 * @property string $single_price_with_material
 * @property string $full_price
 * @property string $price_with_dds
 * @property string $created_at
 * @property string $updated_at
 *
 * @property OrderList[] $orderLists
 * @property Order[] $orders
 * @property Firm $firm
 * @property Material $material
 */
class ProductBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firm_id', 'quantity', 'material_id'], 'integer'],
            [['price', 'weight', 'price_for_cutting', 'full_weight', 'single_price_with_material', 'full_price', 'price_with_dds'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_name'], 'string', 'max' => 255],
            [['firm_id'], 'exist', 'skipOnError' => true, 'targetClass' => Firm::className(), 'targetAttribute' => ['firm_id' => 'id']],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Material::className(), 'targetAttribute' => ['material_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firm_id' => 'Firm ID',
            'product_name' => 'Product Name',
            'quantity' => 'Quantity',
            'material_id' => 'Material ID',
            'price' => 'Price',
            'weight' => 'Weight',
            'price_for_cutting' => 'Price For Cutting',
            'full_weight' => 'Full Weight',
            'single_price_with_material' => 'Single Price With Material',
            'full_price' => 'Full Price',
            'price_with_dds' => 'Price With Dds',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderLists()
    {
        return $this->hasMany(OrderList::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['id' => 'order_id'])->viaTable('order_list', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirm()
    {
        return $this->hasOne(Firm::className(), ['id' => 'firm_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['id' => 'material_id']);
    }
}

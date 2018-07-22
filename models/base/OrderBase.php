<?php

namespace app\models\base;

use Yii;
use app\models\Firm;
use app\models\OrderList;
use app\models\Product;
/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $firm_id
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Firm $firm
 * @property OrderList[] $orderLists
 * @property Product[] $products
 */
class OrderBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firm_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['firm_id'], 'exist', 'skipOnError' => true, 'targetClass' => Firm::className(), 'targetAttribute' => ['firm_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firm_id' => 'Firm ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public function getOrderLists()
    {
        return $this->hasMany(OrderList::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('order_list', ['order_id' => 'id']);
    }
}

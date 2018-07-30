<?php

use yii\db\Migration;

/**
 * Class m180729_153032_fixing_order_product_relation
 */
class m180729_153032_fixing_order_product_relation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('order_list_order_id', 'order_list');
        $this->dropForeignKey('order_list_product_id', 'order_list');
        $this->dropTable('order_list');

        $this->addColumn('product', 'order_id', $this->integer(11)->notNull());

        $this->addForeignKey('product_order_id', 'product', 'order_id', 'order', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('product_order_id', 'product');
        $this->dropColumn('product', 'order_id');

        $this->createTable('order_list', [
            'order_id' => $this->integer(11),
            'product_id' => $this->integer(11),
        ]);

        $this->addPrimaryKey('order_list_pk', 'order_list', ['order_id', 'product_id']);
        $this->addForeignKey('order_list_order_id', 'order_list', 'order_id', 'order', 'id');
        $this->addForeignKey('order_list_product_id', 'order_list', 'product_id', 'product', 'id');
    }
}

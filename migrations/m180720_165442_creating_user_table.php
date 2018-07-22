<?php

use yii\db\Migration;

class m180720_165442_creating_user_table extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('user',[
            'id' => $this->primaryKey(),
            'username' => $this->string(255),
            'password' => $this->string(255),
            'name' => $this->string(255),
            'email' => $this->string(255),
            'status' => $this->integer(1),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createTable('firm',[
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'email' => $this->string(255),
            'address' => $this->string(255),
            'phone_number' => $this->string(15),
            'city' => $this->string(255),
            'country' => $this->string(255),
            'owner_name' => $this->string(255),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'firm_id' => $this->integer(11),
            'product_name' => $this->string(255),
            'quantity' => $this->integer(5),
            'material' => $this->string(255),
            'price' => $this->decimal(10,2),
            'weight' => $this->decimal(10,3),
            'price_for_cutting' => $this->decimal(10,2),
            'full_weight' => $this->decimal(10,3),
            'single_price_with_material' => $this->decimal(10, 2),
            'full_price' => $this->decimal(10,2),
            'price_with_dds' => $this->decimal(10,2),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey('product_firm_id', 'product', 'firm_id', 'firm', 'id');

        $this->createTable('order',[
            'id' => $this->primaryKey(),
            'firm_id' => $this->integer(11),
            'status' => $this->integer(1),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('order_firm_id', 'order', 'firm_id' , 'firm', 'id');

        $this->createTable('order_list', [
            'order_id' => $this->integer(11),
            'product_id' => $this->integer(11),
        ]);

        $this->addPrimaryKey('order_list_pk', 'order_list', ['order_id', 'product_id']);
        $this->addForeignKey('order_list_order_id', 'order_list', 'order_id', 'order', 'id');
        $this->addForeignKey('order_list_product_id', 'order_list', 'product_id', 'product', 'id');

        $this->insert('user', ['username' => 'admin', 'password' => \Yii::$app->security->generatePasswordHash('admin'), 'name' => 'admin', 'email' => 'admin@admin.bg', 'status' => 1]);
    }

    public function safeDown()
    {
        $this->dropForeignKey('order_list_order_id', 'order_list');
        $this->dropForeignKey('order_list_product_id', 'order_list');
        $this->dropForeignKey('order_firm_id', 'order');
        $this->dropForeignKey('product_firm_id', 'product');

        $this->dropTable('order_list');
        $this->dropTable('order');
        $this->dropTable('product');
        $this->dropTable('firm');
        $this->dropTable('user');
    }
}

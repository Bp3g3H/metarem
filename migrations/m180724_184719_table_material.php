<?php

use yii\db\Migration;

/**
 * Class m180724_184719_table_material
 */
class m180724_184719_table_material extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('material',[
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'price' => $this->decimal(7, 2),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->alterColumn('product', 'material', $this->integer(11));
        $this->renameColumn('product', 'material', 'material_id');

        $this->addForeignKey('product_material_id', 'product', 'material_id', 'material', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('product_material_id', 'product');
        $this->renameColumn('product', 'material_id', 'material');
        $this->alterColumn('product', 'material', $this->string(255));

        $this->dropTable('material');
    }
}

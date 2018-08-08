<?php

use yii\db\Migration;

/**
 * Class m180807_203050_add_service_column
 */
class m180807_203050_add_service_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'services', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product', 'services');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m180812_201807_removing_country_from_firm
 */
class m180812_201807_removing_country_from_firm extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('firm', 'country');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('firm', 'country', $this->string(255));
    }
}

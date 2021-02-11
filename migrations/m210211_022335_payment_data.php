<?php

use yii\db\Migration;

/**
 * Class m210211_022335_payment_data
 */
class m210211_022335_payment_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'payment_data_id', $this->string(100));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('user', 'payment_data_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210211_022335_payment_data cannot be reverted.\n";

        return false;
    }
    */
}

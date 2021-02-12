<?php

use app\components\ABTestManager;
use yii\db\Migration;

/**
 * Class m210212_002808_ab_tests
 */
class m210212_002808_ab_tests extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ab_tests_variants', [
            'id' => $this->primaryKey(),
            'test_name' => $this->string(50)->notNull(),
            'variation_name' => $this->string(50)->notNull(),
            'assigned_users_count' => $this->integer()->notNull(),
            'conversions_count' => $this->integer()->notNull(),
        ]);

        $this->insert('ab_tests_variants', [
            'test_name' => ABTestManager::REGISTER_VIEW_TEST,
            'variation_name' => 'register-form-a',
            'assigned_users_count' => 0,
            'conversions_count' => 0,
        ]);

        $this->insert('ab_tests_variants', [
            'test_name' => ABTestManager::REGISTER_VIEW_TEST,
            'variation_name' => 'register-form-b',
            'assigned_users_count' => 0,
            'conversions_count' => 0,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ab_tests_variants');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210212_002808_ab_tests cannot be reverted.\n";

        return false;
    }
    */
}

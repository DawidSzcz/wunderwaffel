<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m210209_000627_initial
 */
class m210209_000627_initial extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(50)->notNull(),
            'lastname' => $this->string(50)->notNull(),
            'telephone' => $this->string(20)->notNull(),
            'street' => $this->string(50)->notNull(),
            'house_number' => $this->string(20)->notNull(),
            'zip' => $this->string(20)->notNull(),
            'city' => $this->string(50)->notNull(),
            'iban' => $this->string(50)->notNull(),
            'account_owner' => $this->string(50)->notNull(),
        ]);

        $this->createTable('session', [
            'id' => 'CHAR(40) NOT NULL PRIMARY KEY',
            'expire' => $this->integer(),
            'data' => 'BLOB'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
        $this->dropTable('session');
    }
}

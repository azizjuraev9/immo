<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency}}`.
 */
class m201019_151444_create_currency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(70)->notNull(),
            'code' => $this->string(5)->notNull(),
            'rate' => $this->float()->notNull(),
            'insert_dt' => $this
                ->dateTime()
                ->defaultExpression('current_timestamp')
                ->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%currency}}');
    }
}

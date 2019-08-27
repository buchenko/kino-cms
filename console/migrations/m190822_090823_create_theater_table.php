<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%theater}}`.
 */
class m190822_090823_create_theater_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('theater', [
            'id' => $this->primaryKey(),
            'name' => $this->string(250)->notNull(),
            'description' => $this->text()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('theater');
    }
}

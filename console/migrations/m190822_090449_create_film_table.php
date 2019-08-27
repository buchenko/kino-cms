<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%film}}`.
 */
class m190822_090449_create_film_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('film', [
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
        $this->dropTable('film');
    }
}

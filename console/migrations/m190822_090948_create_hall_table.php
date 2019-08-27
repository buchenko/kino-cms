<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hall}}`.
 */
class m190822_090948_create_hall_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('hall', [
            'id' => $this->primaryKey(),
            'name' => $this->string(250)->notNull(),
            'description' => $this->text()->defaultValue(null),
            'theater_id' => $this->integer()->notNull(),
        ]);
        $this->createIndex(
            'idx-hall-theater_id',
            'hall',
            'theater_id'
        );

        $this->addForeignKey(
            'fk-hall-theater_id',
            'hall',
            'theater_id',
            'theater',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('hall');
    }
}

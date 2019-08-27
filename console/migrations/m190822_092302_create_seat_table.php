<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seat}}`.
 */
class m190822_092302_create_seat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('seat', [
            'id' => $this->primaryKey(),
            'hall_id' => $this->integer()->notNull(),
            'row' => $this->integer()->notNull(),
            'number' => $this->integer()->notNull(),
        ]);
        $this->createIndex(
            'idx-seat-unique-row-number',
            'seat',
            ['row', 'number'],
            true
        );
        $this->createIndex(
            'idx-seat-hall_id',
            'seat',
            'hall_id'
        );

        $this->addForeignKey(
            'fk-seat-hall_id',
            'seat',
            'hall_id',
            'hall',
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
        $this->dropTable('seat');
    }
}

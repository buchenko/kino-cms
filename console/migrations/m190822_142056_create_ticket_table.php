<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ticket}}`.
 */
class m190822_142056_create_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ticket', [
            'id' => $this->primaryKey(),
            'showtime_id' => $this->integer()->notNull(),
            'seat_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'paid' => $this->boolean()->defaultValue(false),
            'date_time' => $this->dateTime()->notNull()->defaultValue(new \yii\db\Expression('NOW()')),
        ]);

        $this->createIndex(
            'idx-ticket-unique-showtime_id-seat_id',
            'ticket',
            ['showtime_id', 'seat_id'],
            true
        );

        $this->createIndex(
            'idx-ticket-showtime_id',
            'ticket',
            'showtime_id'
        );
        $this->addForeignKey(
            'fk-ticket-showtime_id',
            'ticket',
            'showtime_id',
            'showtime',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-ticket-seat_id',
            'ticket',
            'seat_id'
        );
        $this->addForeignKey(
            'fk-ticket-seat_id',
            'ticket',
            'seat_id',
            'seat',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-ticket-user_id',
            'ticket',
            'user_id'
        );
        $this->addForeignKey(
            'fk-ticket-user_id',
            'ticket',
            'user_id',
            'user',
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
        $this->dropTable('ticket');
    }
}

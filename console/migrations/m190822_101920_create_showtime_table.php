<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%showtime}}`.
 */
class m190822_101920_create_showtime_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('showtime', [
            'id' => $this->primaryKey(),
            'film_id' => $this->integer()->notNull(),
            'hall_id' => $this->integer()->notNull(),
            'date_time' => $this->dateTime()->notNull(),
        ]);
        $this->createIndex(
            'idx-showtime-film_id',
            'showtime',
            'film_id'
        );

        $this->addForeignKey(
            'fk-showtime-film_id',
            'showtime',
            'film_id',
            'film',
            'id',
            'CASCADE',
            'RESTRICT'
        );
        $this->createIndex(
            'idx-showtime-hall_id',
            'showtime',
            'hall_id'
        );

        $this->addForeignKey(
            'fk-showtime-hall_id',
            'showtime',
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
        $this->dropTable('{{%showtime}}');
    }
}

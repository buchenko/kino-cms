<?php

namespace common\models;

use common\models\query\SeatQuery;
use Yii;

/**
 * This is the model class for table "seat".
 *
 * @property int $id
 * @property int $hall_id
 * @property int $row
 * @property int $number
 *
 * @property Hall $hall
 * @property Ticket[] $tickets
 */
class Seat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hall_id', 'row', 'number'], 'required'],
            [['hall_id', 'row', 'number'], 'default', 'value' => null],
            [['hall_id', 'row', 'number'], 'integer'],
            [['row', 'number'], 'unique', 'targetAttribute' => ['row', 'number']],
            [['hall_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hall::class, 'targetAttribute' => ['hall_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hall_id' => Yii::t('app', 'Hall'),
            'row' => Yii::t('app', 'Row'),
            'number' => Yii::t('app', 'Number'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHall()
    {
        return $this->hasOne(Hall::class, ['id' => 'hall_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::class, ['seat_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SeatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SeatQuery(get_called_class());
    }
}

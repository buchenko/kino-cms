<?php

namespace common\models;

use common\models\query\TicketQuery;
use Yii;
use yii\base\InvalidCallException;

/**
 * This is the model class for table "ticket".
 *
 * @property int $id
 * @property int $showtime_id
 * @property int $seat_id
 * @property int $user_id
 * @property boolean $paid
 * @property string $date_time
 *
 * @property Seat $seat
 * @property Showtime $showtime
 * @property User $user
 */
class Ticket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['showtime_id', 'seat_id', 'user_id'], 'required'],
            [['showtime_id', 'seat_id', 'user_id'], 'default', 'value' => null],
            [['showtime_id', 'seat_id', 'user_id'], 'integer'],
            [['showtime_id', 'seat_id'], 'unique', 'targetAttribute' => ['showtime_id', 'seat_id']],
            [['paid'], 'boolean'],
            [['date_time'], 'datetime', 'format' => 'php:Y-m-d H:i', 'min' => date('Y-m-d H:i')],
            [['seat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seat::class, 'targetAttribute' => ['seat_id' => 'id']],
            [['showtime_id'], 'exist', 'skipOnError' => true, 'targetClass' => Showtime::class, 'targetAttribute' => ['showtime_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'showtime_id' => Yii::t('app', 'Showtime'),
            'seat_id' => Yii::t('app', 'Seat'),
            'user_id' => Yii::t('app', 'User'),
            'paid' => Yii::t('app', 'Paid'),
            'date_time' => Yii::t('app', 'Date Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeat()
    {
        return $this->hasOne(Seat::class, ['id' => 'seat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowtime()
    {
        return $this->hasOne(Showtime::class, ['id' => 'showtime_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return TicketQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketQuery(get_called_class());
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        if ($this->paid) {
            throw  new InvalidCallException('Can not delete paid ticket');
        }

        return parent::beforeDelete();
    }

    /**
     * @return array|false
     */
    public function fields()
    {
        return [
            'id' => 'id',
            'paid' => 'paid',
            'date_time' => 'date_time',
        ];
    }

}

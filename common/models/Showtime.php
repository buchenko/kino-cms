<?php

namespace common\models;

use common\models\query\ShowtimeQuery;
use Yii;

/**
 * This is the model class for table "showtime".
 *
 * @property int $id
 * @property int $film_id
 * @property int $hall_id
 * @property string $date_time
 *
 * @property Film $film
 * @property Hall $hall
 * @property Ticket[] $tickets
 */
class Showtime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'showtime';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['film_id', 'hall_id', 'date_time'], 'required'],
            [['film_id', 'hall_id'], 'default', 'value' => null],
            [['film_id', 'hall_id'], 'integer'],
            [['date_time'], 'safe'],
            [['film_id'], 'exist', 'skipOnError' => true, 'targetClass' => Film::class, 'targetAttribute' => ['film_id' => 'id']],
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
            'film_id' => Yii::t('app', 'Film'),
            'hall_id' => Yii::t('app', 'Hall'),
            'date_time' => Yii::t('app', 'Date Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilm()
    {
        return $this->hasOne(Film::class, ['id' => 'film_id']);
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
        return $this->hasMany(Ticket::class, ['showtime_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ShowtimeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShowtimeQuery(get_called_class());
    }
}

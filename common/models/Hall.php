<?php

namespace common\models;

use common\models\query\HallQuery;
use Yii;

/**
 * This is the model class for table "hall".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $theater_id
 *
 * @property Theater $theater
 * @property Seat[] $seats
 * @property Showtime[] $showtimes
 */
class Hall extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hall';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'theater_id'], 'required'],
            [['description'], 'string'],
            [['theater_id'], 'default', 'value' => null],
            [['theater_id'], 'integer'],
            [['name'], 'string', 'max' => 250],
            [['theater_id'], 'exist', 'skipOnError' => true, 'targetClass' => Theater::class, 'targetAttribute' => ['theater_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'theater_id' => Yii::t('app', 'Theater'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTheater()
    {
        return $this->hasOne(Theater::class, ['id' => 'theater_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeats()
    {
        return $this->hasMany(Seat::class, ['hall_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowtimes()
    {
        return $this->hasMany(Showtime::class, ['hall_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return HallQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HallQuery(get_called_class());
    }
}

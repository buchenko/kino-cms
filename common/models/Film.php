<?php

namespace common\models;

use common\models\query\FilmQuery;
use Yii;

/**
 * This is the model class for table "film".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property Showtime[] $showtimes
 */
class Film extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'film';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 250],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowtimes()
    {
        return $this->hasMany(Showtime::class, ['film_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return FilmQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FilmQuery(get_called_class());
    }
}

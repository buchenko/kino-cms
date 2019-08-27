<?php

namespace common\models;

use common\models\query\TheaterQuery;
use Yii;

/**
 * This is the model class for table "theater".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property Hall[] $halls
 */
class Theater extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'theater';
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
    public function getHalls()
    {
        return $this->hasMany(Hall::class, ['theater_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TheaterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TheaterQuery(get_called_class());
    }
}

<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Showtime;

/**
 * ShowtimeSearch represents the model behind the search form of `common\models\Showtime`.
 */
class ShowtimeSearch extends Showtime
{
    /**
     * @var string
     */
    public $dateInterval;
    /**
     * @var string
     */
    public $startDate;

    /**
     * @var string
     */
    public $endDate;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'film_id', 'hall_id'], 'integer'],
            [['startDate', 'endDate'], 'date', 'format' => 'php:Y-m-d',],
            [['dateInterval'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Showtime::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if ($this->endDate == 'Invalid date'){
            $this->endDate = null;
            $this->dateInterval = null;
        }
        if ($this->startDate == 'Invalid date'){
            $this->startDate = null;
            $this->dateInterval = null;
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if ($this->startDate || $this->endDate) {
            $query->andFilterWhere(['between', '(date_time)::date', $this->startDate, $this->endDate]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'film_id' => $this->film_id,
            'hall_id' => $this->hall_id,
        ]);

        return $dataProvider;
    }
}

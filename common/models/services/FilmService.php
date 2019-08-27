<?php

namespace common\models\services;

use yii\base\Component;
use yii\helpers\ArrayHelper;
use common\models\Film;

/**
 * Class FilmService
 * @package common\models\services
 */
class FilmService extends Component
{
    /**
     * @var Film
     */
    protected $film;

    public function __construct(Film $film, $config = [])
    {
        $this->film = $film;
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public static function getFilmList()
    {
        $films = Film::find()->asArray()->all();
        $list = ArrayHelper::map($films, 'id', 'name');
        krsort($list);

        return $list;
    }

}
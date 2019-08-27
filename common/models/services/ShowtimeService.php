<?php

namespace common\models\services;

use common\models\Showtime;
use yii\base\Component;
use yii\helpers\ArrayHelper;

/**
 * Class ShowtimeService
 * @package common\models\services
 *
 * @property string $showtimeDescription
 */
class ShowtimeService extends Component
{
    /**
     * @var Showtime
     */
    protected $showtime;

    public function __construct(Showtime $showtime, $config = [])
    {
        $this->showtime = $showtime;
        parent::__construct($config);
    }

    /**
     * @return string
     */
    public function getShowtimeDescription()
    {
        $hallService = new HallService($this->showtime->hall);
        $description = $this->showtime->film->name . ' / ' . $hallService->getHallDescription() . ' / ' . $this->showtime->date_time;

        return $description;
    }

    /**
     * @return array
     */
    public static function getShowtimeList()
    {
        $showtimes = Showtime::find()->all();
        $list = ArrayHelper::map($showtimes, 'id', function (Showtime $showtime){
            $hallService = new HallService($showtime->hall);
            return $showtime->film->name . ' / ' .  $hallService->getHallDescription() . ' / ' . $showtime->date_time;
        });
        krsort($list);

        return $list;
    }

}
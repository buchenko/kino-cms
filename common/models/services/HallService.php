<?php

namespace common\models\services;

use yii\base\Component;
use yii\helpers\ArrayHelper;
use common\models\Hall;

/**
 * Class HallService
 * @package common\models\services
 *
 * @property string $hallDescription
 */
class HallService extends Component
{
    /**
     * @var Hall
     */
    protected $hall;

    public function __construct(Hall $hall, $config = [])
    {
        $this->hall = $hall;
        parent::__construct($config);
    }

    /**
     * @return string
     */
    public function getHallDescription()
    {
        $description = $this->hall->theater->name . ': ' . $this->hall->name;

        return $description;
    }

    /**
     * @param $theaterId
     *
     * @return array
     */
    public static function getTheaterHallList($theaterId)
    {
        $halls = Hall::find()->where(['theater_id' => $theaterId])->asArray()->all();
        $list = ArrayHelper::map($halls, 'id', 'name');
        krsort($list);

        return $list;
    }

    /**
     * @return array
     */
    public static function getHallList()
    {
        $halls = Hall::find()->all();
        $list = ArrayHelper::map($halls, 'id', function (Hall $hall){
        return $hall->theater->name . ': ' . $hall->name;
    });
        krsort($list);

        return $list;
    }

}
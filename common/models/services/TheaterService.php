<?php

namespace common\models\services;

use common\models\Theater;
use yii\base\Component;
use yii\helpers\ArrayHelper;

/**
 * Class TheaterService
 * @package common\models\services
 */
class TheaterService extends Component
{
    /**
     * @var Theater
     */
    protected $theater;

    public function __construct(Theater $theater, $config = [])
    {
        $this->theater = $theater;
        parent::__construct($config);
    }

    /**
     * @param $theaterId
     *
     * @return array
     */
    public static function getTheaterList()
    {
        $theaters = Theater::find()->asArray()->all();
        $list = ArrayHelper::map($theaters, 'id', 'name');
        krsort($list);

        return $list;
    }

}
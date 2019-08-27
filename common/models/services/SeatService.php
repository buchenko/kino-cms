<?php

namespace common\models\services;

use common\models\Seat;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Class SeatService
 * @package common\models\services
 *
 * @property string $seatDescription
 */
class SeatService extends Component
{
    /**
     * @var Seat
     */
    protected $seat;

    public function __construct(Seat $seat, $config = [])
    {
        $this->seat = $seat;
        parent::__construct($config);
    }

    /**
     * @return string
     */
    public function getSeatDescription()
    {
        $description = Yii::t('app', 'Seat {number}, row {row}', ['number' => $this->seat->number, 'row' => $this->seat->row]);

        return $description;
    }

    /**
     * @return array
     */
    public static function getSeatList()
    {
        $seats = Seat::find()->all();
        $list = ArrayHelper::map($seats, 'id', function (Seat $seat){
            return Yii::t('app', 'Seat {number}, row {row}', ['number' => $seat->number, 'row' => $seat->row]);
        });
        krsort($list);

        return $list;
    }

    /**
     * @param $hallId
     * @param bool $depDrop
     *
     * @return array
     */
    public static function getSeatsHallList($hallId, $depDrop = true)
    {
        $seats = Seat::find()->where(['hall_id' => $hallId])->all();
        $list = [];
        if ($depDrop){
            foreach ($seats as $seat){
                $list[] = [
                    'id' => $seat->id,
                    'name' => Yii::t('app', 'Seat {number}, row {row}', ['number' => $seat->number, 'row' => $seat->row])
                ];
            }
        }else{
            $list = ArrayHelper::map($seats, 'id', function (Seat $seat){
                return Yii::t('app', 'Seat {number}, row {row}', ['number' => $seat->number, 'row' => $seat->row]);
            });
        }
        krsort($list);

        return $list;
    }

}
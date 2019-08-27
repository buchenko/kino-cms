<?php

namespace common\models\services;

use common\models\Ticket;
use yii\base\Component;
use yii\helpers\ArrayHelper;

/**
 * Class TicketService
 * @package common\models\services
 *
 * @property string $ticketDescription
 * @property string $ticketStatusDescription
 * @property string $showtimeDescription
 */
class TicketService extends Component
{
    /**
     * @var Ticket
     */
    protected $ticket;

    public function __construct(Ticket $ticket, $config = [])
    {
        $this->ticket = $ticket;
        parent::__construct($config);
    }

    /**
     * @return string
     */
    public function getTicketDescription()
    {
        $showtimeService = new ShowtimeService($this->ticket->showtime);
        $seatService = new SeatService($this->ticket->seat);
        $description = $showtimeService->getShowtimeDescription() . ' / ' . $seatService->getSeatDescription();

        return $description;
    }

    /**
     * @return string
     */
    public function getTicketStatusDescription()
    {
        return ArrayHelper::getValue(static::getTicketStatusList(), $this->ticket->paid);
    }

    /**
     * @return array
     */
    public static function getTicketStatusList()
    {
        $statuses = [
            false => \Yii::t('app', 'Reserved'),
            true => \Yii::t('app', 'Paid'),
        ];

        return $statuses;
    }

    /**
     * @todo implement pay-service
     *
     * @return bool
     */
    public function pay()
    {
        return (bool)rand(0, 1);
    }

}
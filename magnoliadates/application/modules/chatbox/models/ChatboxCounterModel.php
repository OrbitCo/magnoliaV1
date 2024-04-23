<?php

namespace Pg\modules\chatbox\models;

class ChatboxCounterModel extends \Model
{
    /**
     * @var string
     */
    public const DB_DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * @var ChatboxModel
     */
    private $chatbox_model;

    /**
     * ChatboxCounterModel constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->chatbox_model = new ChatboxModel();
    }

    /**
     * Number of messages (hours)
     *
     * @param $hours
     *
     * @return int
     */
    public function getCountHours($hours): int
    {
        return $this->chatbox_model->getCount(['where' => [
            'dir' => 'o',
            'date_added >' => date(self::DB_DATE_FORMAT, strtotime("-$hours hours"))
        ]]);
    }

    /**
     * Number of messages (days)
     *
     * @param $days
     *
     * @return int
     */
    public function getCountDays($days): int
    {
        return $this->chatbox_model->getCount(['where' => [
            'dir' => 'o',
            'date_added >' => date(self::DB_DATE_FORMAT, strtotime("-$days days"))
        ]]);
    }

    /**
     * Number of messages (weeks)
     *
     * @param $weeks
     *
     * @return int
     */
    public function getCountWeeks($weeks): int
    {
        return $this->chatbox_model->getCount(['where' => [
            'dir' => 'o',
            'date_added >' => date(self::DB_DATE_FORMAT, strtotime("-$weeks weeks"))
        ]]);
    }

    /**
     * Number of messages (months)
     *
     * @param $months
     *
     * @return int
     */
    public function getCountMonths($months): int
    {
        return $this->chatbox_model->getCount(['where' => [
            'dir' => 'o',
            'date_added >' => date(self::DB_DATE_FORMAT, strtotime("-$months months"))
        ]]);
    }
}

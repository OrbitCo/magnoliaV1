<?php

declare(strict_types=1);

namespace Pg\modules\users\models\events;

use Symfony\Component\EventDispatcher\Event;

class EventUsers extends Event
{
    protected $profileViewFrom;
    protected $profileViewTo;
    protected $searchFrom;
    protected $siteVisits;
    protected $usersIds;
    protected $data = [];

    public function getProfileViewFrom()
    {
        return $this->profileViewFrom;
    }

    public function setProfileViewFrom($value)
    {
        $this->profileViewFrom = $value;
    }

    public function getProfileViewTo()
    {
        return $this->profileViewTo;
    }

    public function setProfileViewTo($value)
    {
        $this->profileViewTo = $value;
    }

    public function getSearchFrom()
    {
        return $this->searchFrom;
    }

    public function setSearchFrom($value)
    {
        $this->searchFrom = $value;
    }

    public function getSiteVisits()
    {
        return $this->siteVisits;
    }

    public function setSiteVisits($value)
    {
        $this->siteVisits = $value;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
    
    public function getUsersIdsData()
    {
        return $this->usersIds;
    }
    
    public function setUsersIdsData($value)
    {
        $this->usersIds = $value;
    }
}

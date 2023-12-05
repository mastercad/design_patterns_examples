<?php

namespace App\Message;

use App\Events\EventInterface;

final class EventNotification
{
    public function __construct(private readonly EventInterface $event)
    {
    }

    public function getEvent(): EventInterface
    {
        return $this->event;
    }
}

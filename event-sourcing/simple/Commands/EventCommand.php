<?php

declare(strict_types=1);

namespace Commands;

require_once __DIR__.'/EventCommandInterface.php';
require_once __DIR__.'/../EventHandler.php';
require_once __DIR__.'/../Events/EventInterface.php';

use EventHandler;
use Events\EventInterface;

abstract class EventCommand implements EventCommandInterface
{
    private EventHandler $eventHandler;

    public function __construct(EventHandler $eventHandler)
    {
        $this->eventHandler = $eventHandler;
    }

    protected function trigger(EventInterface $event)
    {
        $this->eventHandler->handle($event);
    }
}
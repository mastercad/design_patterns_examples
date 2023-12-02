<?php

declare(strict_types=1);

require_once __DIR__.'/Events/EventInterface.php';
require_once __DIR__.'/EventStorage.php';

use Events\EventInterface;

/**
 * EventHandler
 *
 * Here only as EventHandler to outline the rough functionality and keep the code as minimal as possible.
 * Often this is more a collection of different listeners / subscribers.
 *
 */
final class EventHandler
{
    private EventStorage $eventStorage;

    public function __construct(EventStorage $eventStorage)
    {
        $this->eventStorage = $eventStorage;
    }

    public function handle(EventInterface $event)
    {
        $this->eventStorage->log($event);
    }
}

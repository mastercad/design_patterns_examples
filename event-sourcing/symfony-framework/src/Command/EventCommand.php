<?php

declare(strict_types=1);

namespace App\Command;

use App\Events\EventInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\Service\Attribute\Required;

abstract class EventCommand extends Command
{
    private EventDispatcherInterface $eventDispatcher;

    protected function trigger(EventInterface $event)
    {
        $this->eventDispatcher->dispatch($event, 'app.general_event');
    }

    #[Required]
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
}

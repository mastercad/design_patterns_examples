<?php

declare(strict_types=1);

namespace App\Command;

use App\Events\EventInterface;
use App\Message\EventNotification;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Contracts\Service\Attribute\Required;

abstract class EventCommand extends Command
{
    private MessageBusInterface $messageBus;

    protected function trigger(EventInterface $event)
    {
        $this->messageBus->dispatch(new EventNotification($event));
    }

    #[Required]
    public function setEventDispatcher(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }
}

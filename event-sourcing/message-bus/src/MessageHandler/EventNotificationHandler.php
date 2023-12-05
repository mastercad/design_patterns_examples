<?php

namespace App\MessageHandler;

use App\Entity\Event;
use App\Message\EventNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class EventNotificationHandler
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(EventNotification $message)
    {
        $entity = new Event($message->getEvent()->toArray());

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}

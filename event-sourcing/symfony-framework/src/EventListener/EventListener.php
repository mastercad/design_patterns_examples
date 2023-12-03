<?php

namespace App\EventListener;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class EventListener
{
    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly EventConverter $eventConverter)
    {
    }

    #[AsEventListener(event: 'app.general_event')]
    public function onAppGeneralEvent($event): void
    {
        $entity = new Event($event->toArray());

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}

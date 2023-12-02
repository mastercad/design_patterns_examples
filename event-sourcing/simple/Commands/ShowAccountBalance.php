<?php

declare(strict_types=1);

namespace Commands;

require_once __DIR__.'/../EventStorage.php';

use Events\EventInterface;
use EventStorage;

final class ShowAccountBalance
{
    private float $balance = 0.00;

    public function __construct(private readonly EventStorage $eventStorage)
    {
    }

    public function execute(string $account)
    {
        $data = $this->eventStorage->loadAccount($account);

        foreach ($data as $item) {
            $this->handleEventData($item);
        }

        return number_format($this->balance, 2, ',', '.');
    }

    private function handleEventData(array $eventData)
    {
        switch ($eventData['type']) {
            case 'Events\PaidIn':
                $this->balance += (float) $eventData['amount'];
                break;
            case 'Events\PaidOut':
                $this->balance -= (float) $eventData['amount'];
                break;
        }
    }
}

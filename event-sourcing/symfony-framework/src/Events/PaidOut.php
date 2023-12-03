<?php

declare(strict_types=1);

namespace App\Events;

use DateTimeImmutable;

final class PaidOut implements EventInterface
{
    public function __construct(private readonly string $account, private readonly float $amount)
    {
    }

    public function toArray(): array
    {
        return [
            'account' => $this->account,
            'amount' => $this->amount,
            'type' => self::class,
            'dateTime' => new DateTimeImmutable()
        ];
    }
}

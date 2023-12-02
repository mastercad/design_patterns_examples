<?php

declare(strict_types=1);

namespace Events;

use DateTimeImmutable;

require_once __DIR__.'/EventInterface.php';

final class PaidIn implements EventInterface
{
    public function __construct(private readonly string $account, private readonly float $amount)
    {
    }

    public function __toString()
    {
        return json_encode(
            [
                'account' => $this->account,
                'amount' => $this->amount,
                'type' => self::class,
                'dateTime' => new DateTimeImmutable()
            ]
        );
    }
}

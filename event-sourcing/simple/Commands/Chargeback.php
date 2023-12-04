<?php

declare(strict_types=1);

namespace Commands;

require_once __DIR__.'/../Events/ChargedBack.php';

use Events\ChargedBack;

final class Chargeback extends EventCommand
{
    public function execute(string $account, float $amount)
    {
        /* do some logic here */

        $event = new ChargedBack($account, $amount);
        $this->trigger($event);
    }
}

<?php

declare(strict_types=1);

namespace Commands;

require_once __DIR__.'/EventCommand.php';
require_once __DIR__.'/../Events/PaidOut.php';

use Events\PaidOut;

final class Payoff extends EventCommand
{
    public function execute(string $account, float $amount)
    {
        /* do some logic here */

        $event = new PaidOut($account, $amount);
        $this->trigger($event);
    }
}

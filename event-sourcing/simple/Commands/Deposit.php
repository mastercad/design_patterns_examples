<?php

declare(strict_types=1);

namespace Commands;

require_once __DIR__.'/EventCommand.php';
require_once __DIR__.'/../Events/PaidIn.php';

use Events\PaidIn;

final class Deposit extends EventCommand
{
    public function execute(string $account, float $value)
    {
        /* do some logic here */

        $event = new PaidIn($account, $value);
        $this->trigger($event);
    }
}

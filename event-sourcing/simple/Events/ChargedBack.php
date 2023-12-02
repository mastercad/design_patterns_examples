<?php

declare(strict_types=1);

require_once __DIR__.'/EventInterface.php';

namespace Events;

final class ChargedBack implements EventInterface
{
    public function __toString()
    {
        
    }
}

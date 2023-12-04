<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;

final class AccountDoesNotExistsException extends Exception
{
    public function __construct(string $account)
    {
        parent::__construct('Account '.$account.' does not exists.', 404);
    }
}

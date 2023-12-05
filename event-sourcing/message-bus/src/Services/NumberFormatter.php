<?php

declare(strict_types=1);

namespace App\Services;

final class NumberFormatter
{
    public static function format($value)
    {
        return number_format($value, 2, ',', '.');
    }
}

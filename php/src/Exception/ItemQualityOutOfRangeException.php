<?php

declare(strict_types=1);

namespace GildedRose\Exception;

use Exception;

class ItemQualityOutOfRangeException extends Exception
{
    public function __construct(int $value, int $min, int $max)
    {
        parent::__construct("Quality of value $value is outside the range between $min and $max.");
    }
}
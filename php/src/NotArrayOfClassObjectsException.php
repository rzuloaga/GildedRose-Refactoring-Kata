<?php

declare(strict_types=1);

namespace GildedRose;

use Exception;

class NotArrayOfClassObjectsException extends Exception
{
    public function __construct(string $class)
    {
        parent::__construct("Array includes objects which are not of class $class");
    }
}
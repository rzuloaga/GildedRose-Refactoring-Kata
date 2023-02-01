<?php

declare(strict_types=1);

namespace GildedRose;

use Exception;

class NotArrayOfClassObjectsException extends Exception
{
    public function __construct(string $unexpectedClass, string $expectedClass)
    {
        parent::__construct("Array includes object of class $unexpectedClass which is not of class $expectedClass");
    }
}
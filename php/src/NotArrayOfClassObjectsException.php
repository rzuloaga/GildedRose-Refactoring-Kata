<?php

declare(strict_types=1);

namespace GildedRose;

use Exception;

class NotArrayOfClassObjectsException extends Exception
{
    public function __construct($unexpectedValue, string $expectedClass)
    {
        $unexpectedClass = $this->getUnexpectedClass($unexpectedValue);

        parent::__construct("Array includes object of class $unexpectedClass which is not of class $expectedClass");
    }

    private function getUnexpectedClass($unexpectedValue)
    {
        if (is_object($unexpectedValue)) {
            return $unexpectedValue::class;
        }

        return gettype($unexpectedValue);
    }
}
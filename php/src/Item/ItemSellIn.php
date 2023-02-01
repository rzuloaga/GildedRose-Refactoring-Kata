<?php

declare(strict_types=1);

namespace GildedRose\Item;

use GildedRose\ValueObject\IntValueObject;
use GildedRose\ValueObject\StringValueObject;

final class ItemSellIn extends IntValueObject
{
    public function isLessThan(self|int $int)
    {
        if ($int instanceof self) return $this->value < $int->value;
        
        return $this->value < $int;
    }

    public function decrease(): void
    {
        --$this->value;
    }
}

<?php

declare(strict_types=1);

namespace GildedRose\Item;

use GildedRose\ValueObject\StringValueObject;

final class ItemName extends StringValueObject
{
    const AGED_BRIE = 'Aged Brie';
    const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';

    public function isAgedBrie(): bool
    {
        return $this->equals(self::AGED_BRIE);
    }

    public function isBackstagePasses(): bool
    {
        return $this->equals(self::BACKSTAGE_PASSES);
    }

    public function isSulfuras(): bool
    {
        return $this->equals(self::SULFURAS);
    }

    private function equals(self|string $string)
    {
        if ($string instanceof self) return $this->value === $string->value;
        
        return $this->value == $string;
    }
}

<?php

declare(strict_types=1);

namespace GildedRose\Item;

final class AgedBrie extends Item
{
    const AGED_BRIE_DOUBLE_QUALITY_DECREMENT_SELL_IN_THRESHOLD = 0;

    public function update(): void
    {
        $this->decreaseSellIn();
        $this->increaseQuality();
        if ($this->hasToBeSoldInLessThan(self::AGED_BRIE_DOUBLE_QUALITY_DECREMENT_SELL_IN_THRESHOLD)) {
            $this->increaseQuality();
        }
    }
}
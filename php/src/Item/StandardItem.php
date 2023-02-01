<?php

declare(strict_types=1);

namespace GildedRose\Item;

final class StandardItem extends Item
{
    const STANDARD_ITEM_DOUBLE_QUALITY_DECREASE_SELL_IN_THRESHOLD = 0;

    public function update(): void
    {
        $this->decreaseSellIn();
        $this->decreaseQuality();
        if ($this->hasToBeSoldInLessThan(self::STANDARD_ITEM_DOUBLE_QUALITY_DECREASE_SELL_IN_THRESHOLD)) {
            $this->decreaseQuality();
        }
    }
}
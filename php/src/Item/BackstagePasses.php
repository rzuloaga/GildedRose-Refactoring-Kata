<?php

declare(strict_types=1);

namespace GildedRose\Item;

final class BackstagePasses extends Item
{
    const BACKSTAGE_PASSES_DOUBLE_QUALITY_INCREASE_SELL_IN_THRESHOLD = 10;
    const BACKSTAGE_PASSES_TRIPLE_QUALITY_INCREASE_SELL_IN_THRESHOLD = 5;
    const BACKSTAGE_PASSES_QUALITY_RESET_SELL_IN_THRESHOLD = 0;

    public function update(): void
    {
        $this->decreaseSellIn();
        $this->increaseQuality();
        if ($this->hasToBeSoldInLessThan(self::BACKSTAGE_PASSES_DOUBLE_QUALITY_INCREASE_SELL_IN_THRESHOLD)) {
            $this->increaseQuality();
        }
        if ($this->hasToBeSoldInLessThan(self::BACKSTAGE_PASSES_TRIPLE_QUALITY_INCREASE_SELL_IN_THRESHOLD)) {
            $this->increaseQuality();
        }
        if ($this->hasToBeSoldInLessThan(self::BACKSTAGE_PASSES_QUALITY_RESET_SELL_IN_THRESHOLD)) {
            $this->resetQuality();
        }
    }
}
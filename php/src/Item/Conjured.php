<?php

declare(strict_types=1);

namespace GildedRose\Item;

final class Conjured extends Item
{
    public function update(): void
    {
        $this->decreaseSellIn();
        $this->decreaseQuality();
        $this->decreaseQuality();
    }
}
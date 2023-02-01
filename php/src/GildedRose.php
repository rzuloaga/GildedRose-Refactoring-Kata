<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Exception\NotArrayOfClassObjectsException;
use GildedRose\Item\Item;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
        foreach ($this->items as $item) {
            if (! $item instanceof Item) {
                throw new NotArrayOfClassObjectsException($item, Item::class);
            }
        }
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $item->update();
        }
    }
}

<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    const AGED_BRIE = 'Aged Brie';
    const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';

    const AGED_BRIE_DOUBLE_QUALITY_DECREMENT_SELL_IN_THRESHOLD = 0;

    const BACKSTAGE_PASSES_DOUBLE_QUALITY_INCREASE_SELL_IN_THRESHOLD = 10;
    const BACKSTAGE_PASSES_TRIPLE_QUALITY_INCREASE_SELL_IN_THRESHOLD = 5;
    const BACKSTAGE_PASSES_QUALITY_RESET_SELL_IN_THRESHOLD = 0;

    const DEFAULT_ITEM_DOUBLE_QUALITY_DECREASE_SELL_IN_THRESHOLD = 0;

    const MAX_QUALITY = 50;
    const MIN_QUALITY = 0;

    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item->name) {
                case self::SULFURAS:
                    break;
                case self::AGED_BRIE:
                    $this->decreaseSellIn($item);
                    $this->updateAgedBrieQuality($item);
                    break;
                case self::BACKSTAGE_PASSES:
                    $this->decreaseSellIn($item);
                    $this->updateBackstagePassesQuality($item);
                    break;
                default:
                    $this->decreaseSellIn($item);
                    $this->updateDefaultItemQuality($item);
                    break;
            }
        }
    }

    private function updateAgedBrieQuality(Item $item)
    {
        $this->increaseQuality($item);
        if ($item->sellIn < self::AGED_BRIE_DOUBLE_QUALITY_DECREMENT_SELL_IN_THRESHOLD) {
            $this->increaseQuality($item);
        }
    }

    private function updateBackstagePassesQuality(Item $item)
    {
        $this->increaseQuality($item);
        if ($item->sellIn < self::BACKSTAGE_PASSES_DOUBLE_QUALITY_INCREASE_SELL_IN_THRESHOLD) {
            $this->increaseQuality($item);
        }
        if ($item->sellIn < self::BACKSTAGE_PASSES_TRIPLE_QUALITY_INCREASE_SELL_IN_THRESHOLD) {
            $this->increaseQuality($item);
        }
        if ($item->sellIn < self::BACKSTAGE_PASSES_QUALITY_RESET_SELL_IN_THRESHOLD) {
            $this->resetQuality($item);
        }
    }

    private function updateDefaultItemQuality(Item $item)
    {
        $this->decreaseQuality($item);
        if ($item->sellIn < self::DEFAULT_ITEM_DOUBLE_QUALITY_DECREASE_SELL_IN_THRESHOLD) {
            $this->decreaseQuality($item);
        }
    }

    private function decreaseSellIn(Item $item): void
    {
        --$item->sellIn;
    }

    private function increaseQuality(Item $item): void
    {
        if ($item->quality < self::MAX_QUALITY) {
            ++$item->quality;
        }
    }

    private function decreaseQuality(Item $item): void
    {
        if ($item->quality > self::MIN_QUALITY) {
            --$item->quality;
        }
    }

    private function resetQuality(Item $item): void
    {
        $item->quality = 0;
    }
}

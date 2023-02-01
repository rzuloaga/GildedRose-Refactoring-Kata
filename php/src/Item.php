<?php

declare(strict_types=1);

namespace GildedRose;

abstract class Item implements \Stringable
{
    const MAX_QUALITY = 50;
    const MIN_QUALITY = 0;

    public function __construct(
        public ItemName $name,
        public ItemSellIn $sellIn,
        public int $quality
    ) {
    }

    public function __toString(): string
    {
        return (string) "{$this->name}, {$this->sellIn}, {$this->quality}";
    }

    public abstract function update(): void;

    protected function decreaseSellIn(): void
    {
        $this->sellIn->decrease();
    }

    protected function hasToBeSoldInLessThan(int $days): bool
    {
        return $this->sellIn->isLessThan($days);
    }

    protected function increaseQuality(): void
    {
        if ($this->quality < self::MAX_QUALITY) {
            ++$this->quality;
        }
    }

    protected function decreaseQuality(): void
    {
        if ($this->quality > self::MIN_QUALITY) {
            --$this->quality;
        }
    }

    protected function resetQuality(): void
    {
        $this->quality = 0;
    }
}

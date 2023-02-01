<?php

declare(strict_types=1);

namespace GildedRose;

abstract class Item implements \Stringable
{
    public function __construct(
        public ItemName $name,
        public ItemSellIn $sellIn,
        public ItemQuality $quality
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
        $this->quality->increase();
    }

    protected function decreaseQuality(): void
    {
        $this->quality->decrease();
    }

    protected function resetQuality(): void
    {
        $this->quality->reset();
    }
}

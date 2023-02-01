<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\ItemFactory;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    private function randomSellIn(): int
    {
        return random_int(-10, 10);
    }

    private function randomBeforeSellIn(): int
    {
        return random_int(1, 10);
    }

    private function randomAfterSellIn(): int
    {
        return random_int(-10, 0);
    }

    private function updateQuality(Item $item): void
    {
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
    }

    public function testSellInDecreases(): void
    {
        $item = ItemFactory::basedOn('foo', 10, 0);
        $this->updateQuality($item);
        $this->assertSame(9, $item->sellIn->value());
    }

    public function testSellInDecreasesToNegative(): void
    {
        $item = ItemFactory::basedOn('foo', 0, 0);
        $this->updateQuality($item);
        $this->assertSame(-1, $item->sellIn->value());
    }

    public function testQualityDecreasesBeforeSellInDate(): void
    {
        $item = ItemFactory::basedOn('foo', $this->randomBeforeSellIn(), 10);
        $this->updateQuality($item);
        $this->assertSame(9, $item->quality->value());
    }

    public function testQualityDecreasesDoubleAfterSellInDate(): void
    {
        $item = ItemFactory::basedOn('foo', $this->randomAfterSellIn(), 10);
        $this->updateQuality($item);
        $this->assertSame(8, $item->quality->value());
    }

    public function testQualityDoesntGoNegative(): void
    {
        $item = ItemFactory::basedOn('foo', $this->randomSellIn(), 0);
        $this->updateQuality($item);
        $this->assertSame(0, $item->quality->value());
    }

    public function testAgedBrieQualityIncreases(): void
    {
        $item = ItemFactory::basedOn('Aged Brie', $this->randomBeforeSellIn(), 0);
        $this->updateQuality($item);
        $this->assertSame(1, $item->quality->value());
    }

    public function testAgedBrieQualityIncreasesDoubleAfterSellInDate(): void
    {
        $item = ItemFactory::basedOn('Aged Brie', $this->randomAfterSellIn(), 0);
        $this->updateQuality($item);
        $this->assertSame(2, $item->quality->value());
    }

    public function testQualityDoesntGoOver50(): void
    {
        $item = ItemFactory::basedOn('Aged Brie', $this->randomSellIn(), 50);
        $this->updateQuality($item);
        $this->assertSame(50, $item->quality->value());
    }

    public function testSulfurasRemainsImmutable(): void
    {
        $sellIn = $this->randomSellIn();
        $item = ItemFactory::basedOn('Sulfuras, Hand of Ragnaros', $sellIn, 80);
        $this->updateQuality($item);
        $this->assertSame(80, $item->quality->value());
        $this->assertSame($sellIn, $item->sellIn->value());
    }

    public function testBackstagePassesQualityIncreasesBefore10DaysBeforeSellInDate(): void
    {
        $item = ItemFactory::basedOn('Backstage passes to a TAFKAL80ETC concert', random_int(11, 100), 10);
        $this->updateQuality($item);
        $this->assertSame(11, $item->quality->value());
    }

    public function testBackstagePassesQualityIncreasesBetween10And5DaysBeforeSellInDate(): void
    {
        $item = ItemFactory::basedOn('Backstage passes to a TAFKAL80ETC concert', random_int(6, 10), 10);
        $this->updateQuality($item);
        $this->assertSame(12, $item->quality->value());
    }

    public function testBackstagePassesQualityIncreases5DaysBeforeSellInDate(): void
    {
        $item = ItemFactory::basedOn('Backstage passes to a TAFKAL80ETC concert', random_int(1, 5), 10);
        $this->updateQuality($item);
        $this->assertSame(13, $item->quality->value());
    }

    public function testBackstagePassesQualityIsZeroAfterSellInDate(): void
    {
        $item = ItemFactory::basedOn('Backstage passes to a TAFKAL80ETC concert', $this->randomAfterSellIn(), 10);
        $this->updateQuality($item);
        $this->assertSame(0, $item->quality->value());
    }
}

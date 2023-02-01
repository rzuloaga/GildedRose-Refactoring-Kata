<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
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
        $item = new Item('foo', 10, 0);
        $this->updateQuality($item);
        $this->assertSame(9, $item->sellIn);
    }

    public function testSellInDecreasesToNegative(): void
    {
        $item = new Item('foo', 0, 0);
        $this->updateQuality($item);
        $this->assertSame(-1, $item->sellIn);
    }

    public function testQualityDecreasesBeforeSellInDate(): void
    {
        $item = new Item('foo', $this->randomBeforeSellIn(), 10);
        $this->updateQuality($item);
        $this->assertSame(9, $item->quality);
    }

    public function testQualityDecreasesDoubleAfterSellInDate(): void
    {
        $item = new Item('foo', $this->randomAfterSellIn(), 10);
        $this->updateQuality($item);
        $this->assertSame(8, $item->quality);
    }

    public function testQualityDoesntGoNegative(): void
    {
        $item = new Item('foo', $this->randomSellIn(), 0);
        $this->updateQuality($item);
        $this->assertSame(0, $item->quality);
    }

    public function testAgedBrieQualityIncreases(): void
    {
        $item = new Item('Aged Brie', $this->randomBeforeSellIn(), 0);
        $this->updateQuality($item);
        $this->assertSame(1, $item->quality);
    }

    public function testAgedBrieQualityIncreasesDoubleAfterSellInDate(): void
    {
        $item = new Item('Aged Brie', $this->randomAfterSellIn(), 0);
        $this->updateQuality($item);
        $this->assertSame(2, $item->quality);
    }

    public function testQualityDoesntGoOver50(): void
    {
        $item = new Item('Aged Brie', $this->randomSellIn(), 50);
        $this->updateQuality($item);
        $this->assertSame(50, $item->quality);
    }

    public function testSulfurasRemainsImmutable(): void
    {
        $sellIn = $this->randomSellIn();
        $item = new Item('Sulfuras, Hand of Ragnaros', $sellIn, 80);
        $this->updateQuality($item);
        $this->assertSame(80, $item->quality);
        $this->assertSame($sellIn, $item->sellIn);
    }

    public function testBackstagePassesQualityIncreasesBefore10DaysBeforeSellInDate(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', random_int(11, 100), 10);
        $this->updateQuality($item);
        $this->assertSame(11, $item->quality);
    }

    public function testBackstagePassesQualityIncreasesBetween10And5DaysBeforeSellInDate(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', random_int(6, 10), 10);
        $this->updateQuality($item);
        $this->assertSame(12, $item->quality);
    }

    public function testBackstagePassesQualityIncreases5DaysBeforeSellInDate(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', random_int(1, 5), 10);
        $this->updateQuality($item);
        $this->assertSame(13, $item->quality);
    }

    public function testBackstagePassesQualityIsZeroAfterSellInDate(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', $this->randomAfterSellIn(), 10);
        $this->updateQuality($item);
        $this->assertSame(0, $item->quality);
    }
}

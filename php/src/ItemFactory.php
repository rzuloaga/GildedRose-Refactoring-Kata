<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\ValueObject\StringValueObject;

final class ItemFactory
{
    const AGED_BRIE = 'Aged Brie';
    const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';

    public static function basedOn(string $name, int $sellIn, int $quality): Item
    {
        switch ($name) {
            case self::AGED_BRIE:
                return new AgedBrie($name, $sellIn, $quality);
            case self::BACKSTAGE_PASSES:
                return new BackstagePasses($name, $sellIn, $quality);
            case self::SULFURAS:
                return new Sulfuras($name, $sellIn, $quality);
            default:
                return new StandardItem($name, $sellIn, $quality);
        }
    }
}
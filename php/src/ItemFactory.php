<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\ValueObject\StringValueObject;

final class ItemFactory
{
    public static function basedOn(string $name, int $sellIn, int $quality): Item
    {
        $itemName = new ItemName($name);
        $itemSellIn = new ItemSellIn($sellIn);

        if ($itemName->isAgedBrie()) return new AgedBrie($itemName, $itemSellIn, $quality);
        if ($itemName->isBackstagePasses()) return new BackstagePasses($itemName, $itemSellIn, $quality);
        if ($itemName->isSulfuras()) return new Sulfuras($itemName, $itemSellIn, $quality);
        return new StandardItem($itemName, $itemSellIn, $quality);
    }
}
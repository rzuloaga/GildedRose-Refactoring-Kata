<?php

declare(strict_types=1);

namespace GildedRose\Item;

final class ItemFactory
{
    public static function basedOn(string $name, int $sellIn, int $quality): Item
    {
        $itemName = new ItemName($name);
        $itemSellIn = new ItemSellIn($sellIn);
        $itemQuality = ItemQualityFactory::basedOn($name, $quality);

        if ($itemName->isAgedBrie()) return new AgedBrie($itemName, $itemSellIn, $itemQuality);
        if ($itemName->isBackstagePasses()) return new BackstagePasses($itemName, $itemSellIn, $itemQuality);
        if ($itemName->isSulfuras()) return new Sulfuras($itemName, $itemSellIn, $itemQuality);
        return new StandardItem($itemName, $itemSellIn, $itemQuality);
    }
}
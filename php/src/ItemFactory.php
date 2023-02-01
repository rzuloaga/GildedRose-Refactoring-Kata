<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\ValueObject\StringValueObject;

final class ItemFactory
{
    public static function basedOn(string $name, int $sellIn, int $quality): Item
    {
        $itemName = new ItemName($name);

        if ($itemName->isAgedBrie()) return new AgedBrie($itemName, $sellIn, $quality);
        if ($itemName->isBackstagePasses()) return new BackstagePasses($itemName, $sellIn, $quality);
        if ($itemName->isSulfuras()) return new Sulfuras($itemName, $sellIn, $quality);
        return new StandardItem($itemName, $sellIn, $quality);
    }
}
<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\ValueObject\StringValueObject;

final class ItemQualityFactory
{
    public static function basedOn(string $name, int $quality): ItemQuality
    {
        $itemName = new ItemName($name);

        if ($itemName->isSulfuras()) {
            return new SulfurasItemQuality($quality);
        }

        return new ItemQuality($quality);
    }
}
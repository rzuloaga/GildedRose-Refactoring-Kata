<?php

declare(strict_types=1);

namespace GildedRose\Item;

use GildedRose\Exception\ItemQualityOutOfRangeException;
use GildedRose\ValueObject\IntValueObject;

class ItemQuality extends IntValueObject
{
    const MAX_QUALITY = 50;
    const MIN_QUALITY = 0;

    public function __construct(protected int $value)
    {
        if ($value > static::MAX_QUALITY || $value < static::MIN_QUALITY) throw new ItemQualityOutOfRangeException($value, static::MIN_QUALITY, static::MAX_QUALITY);
    }

    public function increase(): void
    {
        if ($this->value < static::MAX_QUALITY) {
            ++$this->value;
        }
    }

    public function decrease(): void
    {
        if ($this->value > static::MIN_QUALITY) {
            --$this->value;
        }
    }

    public function reset(): void
    {
        $this->value = 0;
    }
}

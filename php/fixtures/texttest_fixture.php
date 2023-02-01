<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\ItemFactory;

echo 'OMGHAI!' . PHP_EOL;

$items = [
    ItemFactory::basedOn('+5 Dexterity Vest', 10, 20),
    ItemFactory::basedOn('Aged Brie', 2, 0),
    ItemFactory::basedOn('Elixir of the Mongoose', 5, 7),
    ItemFactory::basedOn('Sulfuras, Hand of Ragnaros', 0, 80),
    ItemFactory::basedOn('Sulfuras, Hand of Ragnaros', -1, 80),
    ItemFactory::basedOn('Backstage passes to a TAFKAL80ETC concert', 15, 20),
    ItemFactory::basedOn('Backstage passes to a TAFKAL80ETC concert', 10, 49),
    ItemFactory::basedOn('Backstage passes to a TAFKAL80ETC concert', 5, 49),
    // this conjured item does not work properly yet
    ItemFactory::basedOn('Conjured Mana Cake', 3, 6),
];

$app = new GildedRose($items);

$days = 2;
if ((is_countable($argv) ? count($argv) : 0) > 1) {
    $days = (int) $argv[1];
}

for ($i = 0; $i < $days; $i++) {
    echo "-------- day $i --------" . PHP_EOL;
    echo 'name, sellIn, quality' . PHP_EOL;
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
    echo PHP_EOL;
    $app->updateQuality();
}

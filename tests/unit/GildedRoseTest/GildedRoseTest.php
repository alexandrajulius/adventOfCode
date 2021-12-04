<?php

declare(strict_types=1);

namespace Tests\unit\GildedRoseTest;

use ApprovalTests\Approvals;
use Generator;
use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class GildedRoseTest extends TestCase
{
    /*public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(GildedRose::class, new GildedRose(new Item()));
    }*/

    /*public function testApproval(): void
    {
        $list = ['zero', 'one', 'two', 'three', 'four', 'five'];
        Approvals::verifyList($list);
    }*/

    /**
     * @dataProvider provideItems
     */
    public function testGetsLastAccValueFromFixedInstructions(array $items, array $expected): void
    {
        (new GildedRose($items))->updateQuality();

        self::assertEquals($expected, $items);
    }

    public function provideItems(): Generator
    {
        yield 'For item foo' => [
            'items' => [new Item('foo', 0, 0)],
            'expected' => [new Item('foo', -1, 0)]
        ];

        yield 'For item foo and quality > 0' => [
            'items' => [new Item('foo', 990, 1)],
            'expected' => [new Item('foo', 989, 0)]
        ];
/*
        yield 'For item Aged Brie' => [
            'items' => [new Item('Aged Brie', 0, 0)],
            'expected' => [new Item('Aged Brie', 0, 0)]
        ];

        yield 'For item Backstage passes to a TAFKAL80ETC concert' => [
            'items' => [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 0)],
            'expected' => [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 0)]
        ];

        yield 'For item Sulfuras, Hand of Ragnaros' => [
            'items' => [new Item('Sulfuras, Hand of Ragnaros', 0, 1)],
            'expected' => [new Item('Sulfuras, Hand of Ragnaros', 0, 0)]
        ];
*/
    }
}

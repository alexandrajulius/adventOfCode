<?php

declare(strict_types=1);

namespace Tests\unit\aoc2020Test\Day06Test;

use aoc2020\Day07\Day07;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day07Test extends TestCase
{
    // Bag procession
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day07::class, new Day07());
    }

    /**
     * @dataProvider provideRulesAndBag
     */
    public function testAmountOfContainingBags(string $input, string $bag, int $expected): void
    {
        $actual = (new Day07())->getAmountOfContainingBags($input, $bag);

        self::assertEquals($expected, $actual);
    }

    public function provideRulesAndBag(): Generator
    {
        yield 'For rules a' => [
            'input' => 'light red bags contain 1 bright white bag, 2 muted yellow bags.
dark orange bags contain 3 bright white bags, 4 muted yellow bags.
bright white bags contain 1 shiny gold bag.
muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.
shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.
dark olive bags contain 3 faded blue bags, 4 dotted black bags.
vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.
faded blue bags contain no other bags.
dotted black bags contain no other bags.',
            'bag' => 'shiny gold',
            'result' => 4
        ];

        yield 'For rules final' => [
            'input' => file_get_contents('./tests/fixtures/aoc2020/day07.txt'),
            'bag' => 'shiny gold',
            'result' => 197
        ];
    }

    /**
     * @dataProvider provideRulesForAmountOfContainedBags
     */

    public function testAmountOfContainedBags(string $input, array $bag, int $expected): void
    {
        $actual = (new Day07())->getAmountOfContainedBags($input, $bag);

        self::assertEquals($expected, $actual);
    }

    public function provideRulesForAmountOfContainedBags(): Generator
    {

        yield 'For rules a' => [
            'input' => 'light red bags contain 1 bright white bag, 2 muted yellow bags.
dark orange bags contain 3 bright white bags, 4 muted yellow bags.
bright white bags contain 1 shiny gold bag.
muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.
shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.
dark olive bags contain 3 faded blue bags, 4 dotted black bags.
vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.
faded blue bags contain no other bags.
dotted black bags contain no other bags.',
            'bag' =>  [
                'count' => 1,
                'bag' => 'shiny gold',
                'resultCount' => 0,
            ],
            'result' => 32
        ];

        yield 'For rules b' => [
            'input' => 'shiny gold bags contain 2 dark red bags.
dark red bags contain 2 dark orange bags.
dark orange bags contain 2 dark yellow bags.
dark yellow bags contain 2 dark green bags.
dark green bags contain 2 dark blue bags.
dark blue bags contain 2 dark violet bags.
dark violet bags contain no other bags.',
            'bag' =>  [
                'count' => 1,
                'bag' => 'shiny gold',
                'resultCount' => 0,
            ],
            'result' => 126
        ];

        yield 'For rules final' => [
            'input' => file_get_contents('./tests/fixtures/aoc2020/day07.txt'),
            'bag' =>  [
                'count' => '1',
                'bag' => 'shiny gold',
            ],
            'result' => 85324
        ];
    }

    /**
     * @dataProvider provideTraversableForContainedBags
     */
    public function testTraverseRulesToGetContainedBags(array $rules, array $bag, array $stack, array $expected): void
    {
        $actual = (new Day07())->traverseRulesToGetContainedBags($rules, $bag, $stack);

        self::assertEquals($expected, $actual);
    }

    public function provideTraversableForContainedBags(): Generator
    {
        yield 'For rules a' => [
            'rules' => [
                'light red' => [
                    '1 bright white',
                    '2 muted yellow',
                ],
                'dark orange' => [
                    '3 bright white',
                    '4 muted yellow',
                ],
                'bright white' => [
                    '1 shiny gold'
                ],
                'muted yellow' => [
                    '2 shiny gold',
                    '9 faded blue',
                ],
                'shiny gold' => [
                    '1 dark olive',
                    '2 vibrant plum',
                ],
                'dark olive' => [
                    '3 faded blue',
                    '4 dotted black',
                ],
                'vibrant plum' => [
                    '5 faded blue',
                    '6 dotted black',
                ],
                'faded blue' => [
                    'no other',
                ],
                'dotted black' => [
                    'no other',
                ],
            ],
            'bag' =>  [
                'count' => 1,
                'bag' => 'shiny gold',
                'resultCount' => [],
            ],
            'stack' => [],
            'result' => [
                [
                    'count' => 1,
                    'bag' => 'dark olive',
                    'resultCount' => [1, 1],
                ],
                [
                    'count' => 3,
                    'bag' => 'faded blue',
                    'resultCount' => [1, 1, 3],
                ],
                [
                    'count' => 4,
                    'bag' => 'dotted black',
                    'resultCount' => [1, 1, 4],
                ],
                [
                    'count' => 2,
                    'bag' => 'vibrant plum',
                    'resultCount' => [1, 2],
                ],
                [
                    'count' => 5,
                    'bag' => 'faded blue',
                    'resultCount' => [1, 2, 5],
                ],
                [
                    'count' => 6,
                    'bag' => 'dotted black',
                    'resultCount' => [1, 2, 6],
                ],
            ]
        ];
    }

    /**
     * @dataProvider provideTraversable
     */
    public function testTraverseRulesToGetContainingBags(array $rules, string $bag, array $expected): void
    {
        $actual = (new Day07())->traverseRulesToGetContainingBags($rules, $bag);

        self::assertEquals($expected, $actual);
    }

    public function provideTraversable(): Generator
    {
        yield 'For rules a' => [
            'rules' => [
                'light red' => [
                    '1 bright white',
                    '2 muted yellow',
                ],
                'dark orange' => [
                    '3 bright white',
                    '4 muted yellow',
                ],
                'bright white' => [
                    '1 shiny gold'
                ],
                'muted yellow' => [
                    '2 shiny gold',
                    '9 faded blue',
                ],
                'shiny gold' => [
                    '1 dark olive',
                    '2 vibrant plum',
                ],
                'dark olive' => [
                    '3 faded blue',
                    '4 dotted black',
                ],
                'vibrant plum' => [
                    '5 faded blue',
                    '6 dotted black',
                ],
                'faded blue' => [
                    'no other',
                ],
                'dotted black' => [
                    'no other',
                ],
            ],
            'bag' => 'shiny gold',
            'result' => [
                'bright white',
                'light red',
                'dark orange',
                'muted yellow',
            ]
        ];
    }
}

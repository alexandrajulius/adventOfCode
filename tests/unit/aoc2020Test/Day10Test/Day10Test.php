<?php

declare(strict_types=1);

namespace Tests\unit\aoc2020Test\Day10Test;

use aoc2020\Day10\Day10;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day10Test extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day10::class, new Day10());
    }

    /**
     * @dataProvider provideNumbersAndRangeSecondPuzzle
     */
    public function testFindsContiguousSetOfInvalidNumbers(string $input, int $expected): void
    {
        $actual = (new Day10())->findContiguousSetOfInvalidNumbers($input);

        self::assertEquals($expected, $actual);
    }

    public function provideNumbersAndRangeSecondPuzzle(): Generator
    {
        yield 'For input a' => [
            'input' => '35
20
15
25
47
40
62
55
65
95
102
117
150
182
127
219
299
277
309
576',
            'range' => 5,
            'inValidNo' => 62
        ];

        yield 'For input final' => [
            'input' => file_get_contents('./tests/fixtures/day09.txt'),
            'range' => 25,
            'inValidNo' => 70672245
        ];
    }
}

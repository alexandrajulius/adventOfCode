<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2024Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2024\Day01\Day01;

final class Day01Test extends TestCase
{
    /**
     * @dataProvider provideInputPartOne
     */
    public function testPartOne(string $input, int $expected): void
    {
        $actual = (new Day01($input))->partOne();

        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartOne(): Generator
    {
        yield 'sample input' => [
            'input' => '3   4
4   3
2   5
1   3
3   9
3   3',
            'expected' => 11
        ];

        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2024/day01.txt'),
            'expected' => 1197984
        ];
    }

    /**
     * @dataProvider provideInputPartTwo
     */
    public function testPartTwo(string $input, int $expected): void
    {
        $actual = (new Day01($input))->partTwo();

        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartTwo(): Generator
    {
        yield 'sample input' => [
            'input' => '3   4
4   3
2   5
1   3
3   9
3   3',
            'expected' => 31
        ];

        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2024/day01.txt'),
            'expected' => 23387399
        ];
    }
}



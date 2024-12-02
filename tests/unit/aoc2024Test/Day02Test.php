<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2024Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2024\Day02\Day02;

final class Day02Test extends TestCase
{
    /**
     * @dataProvider provideInputPartOne
     */
    public function testPartOne(string $input, int $expected): void
    {
        $actual = (new Day02())->partOne($input);

        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartOne(): Generator
    {
        yield 'sample input' => [
            'input' => '7 6 4 2 1
1 2 7 8 9
9 7 6 2 1
1 3 2 4 5
8 6 4 4 1
1 3 6 7 9',
            'expected' => 2
        ];

        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2024/day02.txt'),
            'expected' => 279
        ];
    }
    
    /**
     * @dataProvider provideInputPartTwo
     */
    public function testPartTwo(string $input, int $expected): void
    {
        $actual = (new Day02())->partTwo($input);

        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartTwo(): Generator
    {
        yield 'sample input' => [
            'input' => '7 6 4 2 1
1 2 7 8 9
9 7 6 2 1
1 3 2 4 5
8 6 4 4 1
1 3 6 7 9',
            'expected' => 4
        ];
/*
        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2024/day02.txt'),
            'expected' => 279
        ];
*/
    }
}



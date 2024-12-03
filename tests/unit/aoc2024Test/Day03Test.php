<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2024Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2024\Day03\Day03;

final class Day03Test extends TestCase
{
    /**
     * @dataProvider provideInputPartOne
     */
    public function testPartOne(string $input, int $expected): void
    {
        $actual = (new Day03())->partOne($input);

        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartOne(): Generator
    {
        yield 'sample input' => [
            'input' => 'xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))',
            'expected' => 161
        ];

        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2024/day03.txt'),
            'expected' => 169021493
        ];
    }

    /**
     * @dataProvider provideInputPartTwo
     */
    public function testPartTwo(string $input, int $expected): void
    {
        $actual = (new Day03())->partTwo($input);

        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartTwo(): Generator
    {
        yield 'sample input' => [
            'input' => 'do()xmul(2,4)&mul[3,7]!^don\'t()_mul(5,5)+mul(32,64](mul(11,8)undo()?mul(8,5))',
            'expected' => 48
        ];

        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2024/day03.txt'),
            'expected' => 111762583
        ];
    }
}



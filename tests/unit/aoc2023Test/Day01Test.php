<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2023Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2023\Day01\Day01;

final class Day01Test extends TestCase
{
    /**
     * @dataProvider provideInputPartOne
     */
    public function testPartOne(string $input, int $expected): void
    {
        $actual = (new Day01)->partOne($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartOne(): Generator
    {
        yield 'sample input' => [
            'input' => '1abc2
            pqr3stu8vwx
            a1b2c3d4e5f
            treb7uchet',
            'expected' => 142
        ];

        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day01.txt'),
            'expected' => 54951
        ];
    }

    /**
     * @dataProvider provideInputPartTwo
     */
    public function testPartTwo(string $input, int $expected): void
    {
        $actual = (new Day01)->partTwo($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartTwo(): Generator
    {
        yield 'sample input' => [
            'input' => 'two1nine
            eightwothree
            abcone2threexyz
            xtwone3four
            4nineeightseven2
            zoneight234
            7pqrstsixteen
            1eightkgqtwo8twotwopss',
            'expected' => 293
        ];

        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day01_2nd_task.txt'),
            'expected' => 55218
        ];
    }
    
}



<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2023Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2023\Day09\Day09;

final class Day09Test extends TestCase
{
    /**
     * @dataProvider provideInputPartOne
     */
    
    public function testPartOne(string $input, int $expected): void
    {
        $actual = (new Day09)->partOne($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartOne(): Generator
    {
        yield 'sample input' => [
            'input' => '0 3 6 9 12 15
            1 3 6 10 15 21
            10 13 16 21 30 45',
            'expected' => 114
        ];

        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day09.txt'),
            'expected' => 1798691765
        ]; 
    
    }

    /**
     * @dataProvider provideInputPartTwo
     */
    public function testPartTwo(string $input, int $expected): void
    {
        $actual = (new Day09)->partTwo($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartTwo(): Generator
    {
        yield 'sample input' => [
            'input' => '0 3 6 9 12 15
            1 3 6 10 15 21
            10 13 16 21 30 45',
            'expected' => 2
        ];
     
        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day09.txt'),
            'expected' => 1104
        ];  
    }
}



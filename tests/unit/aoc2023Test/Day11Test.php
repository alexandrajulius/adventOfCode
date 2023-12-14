<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2023Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2023\Day11\Day11;

final class Day11Test extends TestCase
{
    /**
     * @dataProvider provideInputPartOne
    */
    public function testPartOne(string $input, int $expected): void
    {
        $actual = (new Day11)->partOne($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartOne(): Generator
    {
        yield 'sample input' => [
            'input' => '...#......
            .......#..
            #.........
            ..........
            ......#...
            .#........
            .........#
            ..........
            .......#..
            #...#.....',
            'expected' => 374
        ];

        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day11.txt'),
            'expected' => 9418609
        ]; 
    }

    /**
     * @dataProvider provideInputPartTwo
    */    
    public function testPartTwo(string $input, int $expected): void
    {
        $actual = (new Day11)->partTwo($input);
     
        self::assertEquals($expected, $actual);
    }
 
    public static function provideInputPartTwo(): Generator
    {
        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day11.txt'),
            'expected' => 593821230983
        ];    
    }
    
}



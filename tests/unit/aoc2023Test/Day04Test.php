<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2023Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2023\Day04\Day04;

final class Day04Test extends TestCase
{
    /**
     * @dataProvider provideInputPartOne
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day04)->partOne($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartOne(): Generator
    {
        yield 'sample input' => [
            'input' => 'Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53
            Card 2: 13 32 20 16 61 | 61 30 68 82 17 32 24 19
            Card 3:  1 21 53 59 44 | 69 82 63 72 16 21 14  1
            Card 4: 41 92 73 84 69 | 59 84 76 51 58  5 54 83
            Card 5: 87 83 26 28 32 | 88 30 70 12 93 22 82 36
            Card 6: 31 18 13 56 72 | 74 77 10 23 35 67 36 11',
            'expected' => 13
        ];
        
        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day04.txt'),
            'expected' => 20407
        ]; 
    }

     /**
     * @dataProvider provideInputPartTwo
     */
    public function testPartTwo(string $input, int $expected): void
    {
        $actual = (new Day04)->partTwo($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartTwo(): Generator
    {
        yield 'sample input' => [
            'input' => 'Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53
            Card 2: 13 32 20 16 61 | 61 30 68 82 17 32 24 19
            Card 3:  1 21 53 59 44 | 69 82 63 72 16 21 14  1
            Card 4: 41 92 73 84 69 | 59 84 76 51 58  5 54 83
            Card 5: 87 83 26 28 32 | 31 30 70 12 93 22 82 36
            Card 6: 31 18 13 56 72 | 74 77 10 23 35 67 36 11',
            'expected' => 30
        ];
        
        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day04.txt'),
            'expected' => 23027585
        ];  
    }
}



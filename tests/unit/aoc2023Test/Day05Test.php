<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2023Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2023\Day05\Day05;

final class Day05Test extends TestCase
{
    /**
     * @dataProvider provideInputPartOne
     */
     public function testPartOne(string $input, int $expected): void
    {
        $actual = (new Day05)->partOne($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartOne(): Generator
    {
        
        yield 'Sample input' => [
            'input' => 'seeds: 79 14 55 13

            seed-to-soil map:
            50 98 2
            52 50 48
            
            soil-to-fertilizer map:
            0 15 37
            37 52 2
            39 0 15
            
            fertilizer-to-water map:
            49 53 8
            0 11 42
            42 0 7
            57 7 4
            
            water-to-light map:
            88 18 7
            18 25 70
            
            light-to-temperature map:
            45 77 23
            81 45 19
            68 64 13
            
            temperature-to-humidity map:
            0 69 1
            1 0 69
            
            humidity-to-location map:
            60 56 37
            56 93 4',
            'expected' => 35
        ];
        
        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day05.txt'),
            'expected' => 20407
        ]; 
        
    }

}



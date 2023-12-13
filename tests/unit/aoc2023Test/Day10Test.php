<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2023Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2023\Day10\Day10;

final class Day10Test extends TestCase
{
    /**
     * @dataProvider provideInputPartOne
     */
    
    public function testPartOne(string $input, int $expected): void
    {
        $actual = (new Day10)->partOne($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartOne(): Generator
    {
        
        yield 'sample input' => [
            'input' => '..F7.
            .FJ|.
            SJ.L7
            |F--J
            LJ...',
            'expected' => 8
        ];

        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day10.txt'),
            'expected' => 6806
        ]; 
    }
}



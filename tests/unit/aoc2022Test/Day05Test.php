<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2022Test\Day05Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2022\Day05\Day05;

final class Day05Test extends TestCase
{
    /**
     * @dataProvider provideInputFirstTask
     */
     public function testFirstTask(string $input, string $expected): void
    {
        $actual = (new Day05($input))->firstTask();
    
        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
        yield 'Dummy input' => [
            '    [D]    
[N] [C]    
[Z] [M] [P]
 1   2   3 
            
move 1 from 2 to 1
move 3 from 1 to 3
move 2 from 2 to 1
move 1 from 1 to 2',
            'expected' => 'CMZ'
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day05.txt'),
            'expected' => 'FRDSQRRCD'
        ];
    }

    /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, string $expected): void
    {
        $actual = (new Day05($input))->secondTask();
    
        self::assertEquals($expected, $actual);
    }

    public function provideInputSecondTask(): Generator
    {
        yield 'Dummy input' => [
            '    [D]    
[N] [C]    
[Z] [M] [P]
 1   2   3 
            
move 1 from 2 to 1
move 3 from 1 to 3
move 2 from 2 to 1
move 1 from 1 to 2',
            'expected' => 'MCD'
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day05.txt'),
            'expected' => 'HRFTQVWNN'
        ];
    }
}



<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2022Test\Day04Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2022\Day04\Day04;

final class Day04Test extends TestCase
{
    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day04($input))->firstTask();
    
        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
        yield 'Dummy input' => [
            '2-4,6-8
            2-3,4-5
            5-7,7-9
            2-8,3-7
            6-6,4-6
            2-6,4-8',
            'expected' => 2
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day04.txt'),
            'expected' => 657
        ];
    }

     /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day04($input))->secondTask();
    
        self::assertEquals($expected, $actual);
    }

    public function provideInputSecondTask(): Generator
    {
        yield 'Dummy input' => [
            '2-4,6-8
            2-3,4-5
            5-7,7-9
            2-8,3-7
            6-6,4-6
            2-6,4-8',
            'expected' => 4
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day04.txt'),
            'expected' => 938
        ];
    }

}



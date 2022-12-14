<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2022Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2022\Day02\Day02;

final class Day02Test extends TestCase
{
    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day02($input))->firstTask();
    
        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
        yield 'Dummy input' => [
            'input' => 'A Y
            B X
            C Z',
            'expected' => 15
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day02.txt'),
            'expected' => 14297
        ];
    }

     /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day02($input))->secondTask();
    
        self::assertEquals($expected, $actual);
    }

    public function provideInputSecondTask(): Generator
    {
        yield 'Dummy input' => [
            'input' => 'A Y
            B X
            C Z',
            'expected' => 12
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day02.txt'),
            'expected' => 10498
        ];
        
    }
}
<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2022Test\Day01Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2022\Day01\Day01;


final class Day01Test extends TestCase
{
    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day01())->firstTask($input);
    
        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
        yield 'Dummy input' => [
            'input' => '1000
            2000
            3000
            
            4000
            
            5000
            6000
            
            7000
            8000
            9000
            
            10000',
            'expected' => 24000
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day01.txt'),
            'expected' => 70613
        ];
    }

      /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day01())->secondTask($input);
    
        self::assertEquals($expected, $actual);
    }

    public function provideInputSecondTask(): Generator
    {
        yield 'Dummy input' => [
            'input' => '1000
            2000
            3000
            
            4000
            
            5000
            6000
            
            7000
            8000
            9000
            
            10000',
            'expected' => 45000
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day01.txt'),
            'expected' => 205805
        ];
    }
}



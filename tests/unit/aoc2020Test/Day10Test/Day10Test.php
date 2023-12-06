<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2020Test\Day10Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2020\Day10\Day10;

final class Day10Test extends TestCase
{
    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day10)->firstTask($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputFirstTask(): Generator
    {
        
        yield 'Sample input' => [
            'input' => '16
            10
            15
            5
            1
            11
            7
            19
            6
            12
            4',
            'expected' => 35
        ];
        
        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2020/day10.txt'),
            'expected' => 3000
        ];    
    }

    /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day10)->secondTask($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputSecondTask(): Generator
    {
        yield 'Sample input' => [
            'input' => '16
            10
            15
            5
            1
            11
            7
            19
            6
            12
            4',
            'expected' => 8
        ];
        
        yield 'Second sample input' => [
            'input' => '28
            33
            18
            42
            31
            14
            46
            20
            48
            47
            24
            23
            49
            45
            19
            38
            39
            11
            1
            32
            25
            35
            8
            17
            7
            9
            4
            2
            34
            10
            3',
            'expected' => 19208
        ];
        /*
        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2020/day10.txt'),
            'expected' => 3000
        ];    
        */
    }
}

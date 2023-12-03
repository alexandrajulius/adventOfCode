<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2023Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2023\Day02\Day02;

final class Day02Test extends TestCase
{
    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day02)->firstTask($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputFirstTask(): Generator
    {
        yield 'Dummy input' => [
            'input' => 'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
            Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
            Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red
            Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red
            Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
            'expected' => 8
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day02.txt'),
            'expected' => 2085
        ];
    }  

   /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day02)->secondTask($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputSecondTask(): Generator
    {
        yield 'Dummy input' => [
            'input' => 'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
            Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
            Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red
            Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red
            Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
            'expected' => 2286
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day02.txt'),
            'expected' => 79315
        ];
    }    


}



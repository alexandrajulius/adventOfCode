<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2023Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2023\Day03\Day03;

final class Day03Test extends TestCase
{
    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day03)->firstTask($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputFirstTask(): Generator
    {
        
        yield 'Dummy input' => [
            'input' => '467..114..
            ...*......
            ..35..633.
            ......#...
            617*......
            .....+.58.
            ..592.....
            ......755.
            ...$.*....
            .664.598.*
            .........3',
            'expected' => 4364
        ];
        
        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day03.txt'),
            'expected' => 535351
        ];
    }

    /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day03)->secondTask($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputSecondTask(): Generator
    {
        
        yield 'Dummy input' => [
            'input' => '467..114..
            ...*......
            ..35..633.
            ......#...
            617*......
            .....+.58.
            ..592.....
            ......755.
            ...$.*....
            .664.598..',
            'expected' => 467835
        ];
        
        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day03.txt'),
            'expected' => 87287096
        ];
    }
}



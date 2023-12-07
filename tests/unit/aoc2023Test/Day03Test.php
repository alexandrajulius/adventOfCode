<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2023Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2023\Day03\Day03;

final class Day03Test extends TestCase
{
    /**
     * @dataProvider provideInputPartOne
     */
    public function testPartOne(string $input, int $expected): void
    {
        $actual = (new Day03)->partOne($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartOne(): Generator
    {
        yield 'sample input' => [
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
        
        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day03.txt'),
            'expected' => 535351
        ];
    }

    /**
     * @dataProvider provideInputPartTwo
     */
    public function testPartTwo(string $input, int $expected): void
    {
        $actual = (new Day03)->partTwo($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartTwo(): Generator
    {
        
        yield 'sample input' => [
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
        
        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day03.txt'),
            'expected' => 87287096
        ];
    }
}



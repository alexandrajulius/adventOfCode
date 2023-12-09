<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2023Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2023\Day08\Day08;

final class Day08Test extends TestCase
{
    /**
     * @dataProvider provideInputPartOne
     */
    
    public function testPartOne(string $input, int $expected): void
    {
        $actual = (new Day08)->partOne($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartOne(): Generator
    {
        yield 'sample input' => [
            'input' => 'RL

            AAA = (BBB, CCC)
            BBB = (DDD, EEE)
            CCC = (ZZZ, GGG)
            DDD = (DDD, DDD)
            EEE = (EEE, EEE)
            GGG = (GGG, GGG)
            ZZZ = (ZZZ, ZZZ)',
            'expected' => 2
        ];

        yield 'next sample input' => [
            'input' => 'LLR

            AAA = (BBB, BBB)
            BBB = (AAA, ZZZ)
            ZZZ = (ZZZ, ZZZ)',
            'expected' => 6
        ];

        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day08.txt'),
            'expected' => 19637
        ]; 
    }

    /**
     * @dataProvider provideInputPartTwo
     */
    public function testPartTwo(string $input, int $expected): void
    {
        $actual = (new Day08)->partTwo($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartTwo(): Generator
    {
        yield 'sample input' => [
            'input' => 'LR

            11A = (11B, XXX)
            11B = (XXX, 11Z)
            11Z = (11B, XXX)
            22A = (22B, XXX)
            22B = (22C, 22C)
            22C = (22Z, 22Z)
            22Z = (22B, 22B)
            XXX = (XXX, XXX)',
            'expected' => 6
        ];
     /*
        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day08.txt'),
            'expected' => 253718286
        ];  
     */   
    }
}



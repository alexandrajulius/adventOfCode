<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2023Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2023\Day07\Day07;

final class Day07Test extends TestCase
{
    /**
     * @dataProvider provideInputPartOne
     */
     public function testPartOne(string $input, int $expected): void
    {
        $actual = (new Day07)->partOne($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartOne(): Generator
    {
         yield 'sample input' => [
            'input' => '32T3K 765
            T55J5 684
            KK677 28
            KTJJT 220
            QQQJA 483',
            'expected' => 6440
        ];
       
        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day07.txt'),
            'expected' => 255048101
        ]; 
    }

    /**
     * @dataProvider provideInputPartTwo
     */
    public function testPartTwo(string $input, int $expected): void
    {
        $actual = (new Day07)->partTwo($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputPartTwo(): Generator
    {
        yield 'sample input' => [
            'input' => '32T3K 765
            T55J5 684
            KK677 28
            KTJJT 220
            QQQJA 483',
            'expected' => 5905
        ];
       
        yield 'final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2023/day07.txt'),
            'expected' => 253718286
        ];    
    }
}



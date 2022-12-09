<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2022Test\Day05Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2022\Day06\Day06;

final class Day06Test extends TestCase
{
    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $markerLength, int $expected): void
    {
        $actual = (new Day06($input))->task($markerLength);
    
        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
       
        yield 'Dummy input' => [
            'mjqjpqmgbljsphdztnvjfqwrcgsmlb',
            4,
            'expected' => 7
        ];

        yield 'Because' => [
            'nppdvjthqldpwncqszvftbrmjlhg',
            4,
            'expected' => 6
        ];

        yield 'Why not' => [
            'nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg',
            4,
            'expected' => 10
        ];

        yield 'Yay' => [
            'zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw',
            4,
            'expected' => 11
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day06.txt'),
            4,
            'expected' => 1896
        ];
    }

    /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $markerLength, int $expected): void
    {
        $actual = (new Day06($input))->task($markerLength);
        self::assertEquals($expected, $actual);
    }

    public function provideInputSecondTask(): Generator
    {
        yield 'Dummy input' => [
            'mjqjpqmgbljsphdztnvjfqwrcgsmlb',
            14,
            'expected' => 19
        ];

        yield 'Because' => [
            'bvwbjplbgvbhsrlpgdmjqwftvncz',
            14,
            'expected' => 23
        ];

        yield 'Why not' => [
            'nppdvjthqldpwncqszvftbrmjlhg',
            14,
            'expected' => 23
        ];

        yield 'Yay' => [
            'nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg',
            14,
            'expected' => 29
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day06.txt'),
            14,
            'expected' => 3452
        ];
    }
}



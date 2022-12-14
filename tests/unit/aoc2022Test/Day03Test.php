<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2022Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2022\Day03\Day03;

final class Day03Test extends TestCase
{
    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day03())->firstTask($input);
    
        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
        yield 'Dummy input' => [
            'input' => 'vJrwpWtwJgWrhcsFMMfFFhFp
            jqHRNqRjqzjGDLGLrsFMfFZSrLrFZsSL
            PmmdzqPrVvPwwTWBwg
            wMqvLMZHhHMvwLHjbvcjnnSBnvTQFn
            ttgJtRGJQctTZtZT
            CrZsJsPPZsGzwwsLwLmpwMDw',
            'expected' => 157
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day03.txt'),
            'expected' => 8018
        ];
    }

     /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day03())->secondTask($input);
    
        self::assertEquals($expected, $actual);
    }

    public function provideInputSecondTask(): Generator
    {
        yield 'Dummy input' => [
            'input' => 'vJrwpWtwJgWrhcsFMMfFFhFp
            jqHRNqRjqzjGDLGLrsFMfFZSrLrFZsSL
            PmmdzqPrVvPwwTWBwg
            wMqvLMZHhHMvwLHjbvcjnnSBnvTQFn
            ttgJtRGJQctTZtZT
            CrZsJsPPZsGzwwsLwLmpwMDw',
            'expected' => 70
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day03.txt'),
            'expected' => 2518
        ];
    }
}



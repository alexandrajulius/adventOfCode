<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2021Test\Day04Test;

use aoc2021\Day04\Day04;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day04Test extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day04::class, new Day04());
    }

    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day04())->firstTask($input);

        self::assertEquals($expected, $actual);
    }

    /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day04())->secondTask($input);

        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
        yield 'Dummy input first task' => [
            'input' => '7,4,9,5,11,17,23,2,0,14,21,24,10,16,13,6,15,25,12,22,18,20,8,19,3,26,1

22 13 17 11  0
 8  2 23  4 24
21  9 14 16  7
 6 10  3 18  5
 1 12 20 15 19

 3 15  0  2 22
 9 18 13 17  5
19  8  7 25 23
20 11 10 24  4
14 21 16 12  6

14 21 17 24  4
10 16 15  9 19
18  8 23 26 20
22 11 13  6  5
 2  0 12  3  7',
            'expected' => 4512
        ];

        yield 'For input final' => [
            'input' => file_get_contents('./tests/fixtures/aoc2021/day04.txt'),
            'expected' => 74320
        ];
    }

    public function provideInputSecondTask(): Generator
    {
        yield 'For dummy input' => [
            'input' => '7,4,9,5,11,17,23,2,0,14,21,24,10,16,13,6,15,25,12,22,18,20,8,19,3,26,1

22 13 17 11  0
 8  2 23  4 24
21  9 14 16  7
 6 10  3 18  5
 1 12 20 15 19

 3 15  0  2 22
 9 18 13 17  5
19  8  7 25 23
20 11 10 24  4
14 21 16 12  6

14 21 17 24  4
10 16 15  9 19
18  8 23 26 20
22 11 13  6  5
 2  0 12  3  7',
            'expected' => 1924
        ];

        yield 'For input final' => [
            'input' => file_get_contents('./tests/fixtures/aoc2021/day04.txt'),
            'expected' => 17884
        ];
    }
}



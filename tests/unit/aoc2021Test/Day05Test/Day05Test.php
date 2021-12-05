<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2021Test\Day05Test;

use aoc2021\Day05\Day05;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day05Test extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day05::class, new Day05());
    }

    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day05())->firstTask($input);

        self::assertEquals($expected, $actual);
    }

    /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day05())->secondTask($input);

        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {

        yield 'Dummy input first task' => [
            'input' => '0,9 -> 5,9
8,0 -> 0,8
9,4 -> 3,4
2,2 -> 2,1
7,0 -> 7,4
6,4 -> 2,0
0,9 -> 2,9
3,4 -> 1,4
0,0 -> 8,8
5,5 -> 8,2',
            'expected' => 5
        ];

        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day05.txt')),
            'expected' => 7473
        ];
    }

    public function provideInputSecondTask(): Generator
    {
        yield 'For dummy input' => [
            'input' => '0,9 -> 5,9
8,0 -> 0,8
9,4 -> 3,4
2,2 -> 2,1
7,0 -> 7,4
6,4 -> 2,0
0,9 -> 2,9
3,4 -> 1,4
0,0 -> 8,8
5,5 -> 8,2',
            'expected' => 12
        ];

        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day05.txt')),
            'expected' => 24164
        ];
    }
}

<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2021Test\Day09Test;

use aoc2021\Day09\Day09;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day09Test extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day09::class, new Day09());
    }

    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day09())->firstTask($input);

        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
        yield 'Dummy input' => [
            'input' => '2199943210
3987894921
9856789892
8767896789
9899965678',
            'expected' => 15
        ];

        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day09.txt')),
            'expected' => 607
        ];
    }

    /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day09())->secondTask($input);

        self::assertEquals($expected, $actual);
    }

    public function provideInputSecondTask(): Generator
    {
        yield 'Dummy input' => [
            'input' => '2199943210
3987894921
9856789892
8767896789
9899965678',
            'expected' => 1134
        ];

        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day09.txt')),
            'expected' => 607
        ];
    }
}


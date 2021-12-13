<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2021Test\Day11Test;

use aoc2021\Day11\Day11;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day11Test extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day11::class, new Day11());
    }

    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $steps, int $expected): void
    {
        $actual = (new Day11())->firstTask($input, $steps);

        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
        yield 'Dummy input first example' => [
            'input' => '5483143223
2745854711
5264556173
6141336146
6357385478
4167524645
2176841721
6882881134
4846848554
5283751526',
            'steps' => 10,
            'expected' => 204
        ];

        yield 'Dummy input' => [
            'input' => '5483143223
2745854711
5264556173
6141336146
6357385478
4167524645
2176841721
6882881134
4846848554
5283751526',
            'steps' => 100,
            'expected' => 1656
        ];


        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day11.txt')),
            'steps' => 100,
            'expected' => 1694
        ];
    }

    /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day11())->secondTask($input);

        self::assertEquals($expected, $actual);
    }

    public function provideInputSecondTask(): Generator
    {
        yield 'Dummy input' => [
            'input' => '5483143223
2745854711
5264556173
6141336146
6357385478
4167524645
2176841721
6882881134
4846848554
5283751526',
            'expected' => 195
        ];

        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day11.txt')),
            'expected' => 346
        ];
    }
}

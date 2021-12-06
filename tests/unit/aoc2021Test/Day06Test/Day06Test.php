<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2021Test\Day06Test;

use aoc2021\Day06\Day06;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day06Test  extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day06::class, new Day06());
    }

    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $days, int $expected): void
    {
        $actual = (new Day06())->firstTask($input, $days);

        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
        /*
        yield 'Dummy input first task 18 days' => [
            'input' => '3,4,3,1,2',
            'days' => 18,
            'expected' => 26
        ];

        yield 'Dummy input first task 80 days' => [
            'input' => '3,4,3,1,2',
            'days' => 80,
            'expected' => 5934
        ];

        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day06.txt')),
            'days' => 80,
            'expected' => 371379
        ];
*/
        yield 'Dummy input first task 256 days' => [
            'input' => '3,4,3,1,2',
            'days' => 256,
            'expected' => 26984457539
        ];
/*
        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day06.txt')),
            'days' => 256,
            'expected' => 371379
        ];
*/
    }

}

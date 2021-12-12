<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2021Test\Day11Test;

use aoc2021\Day11\Day11;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day11Test  extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day11::class, new Day11());
    }

    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day11())->firstTask($input);

        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
        yield 'Dummy input' => [
            'input' => '11111
19991
19191
19991
11111',
            'expected' => 9
        ];
/*
        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day10.txt')),
            'expected' => 344193
        ];
  */
    }

}

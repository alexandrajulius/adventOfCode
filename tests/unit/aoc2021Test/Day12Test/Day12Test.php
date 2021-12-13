<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2021Test\Day12Test;

use aoc2021\Day12\Day12;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day12Test extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day12::class, new Day12());
    }

    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day12())->firstTask($input);

        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
        yield 'Dummy input' => [
            'input' => '',
            'expected' => 0
        ];
/*
        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day12.txt')),
            'expected' => 1694
        ];
  */
    }
}

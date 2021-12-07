<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2021Test\Day07Test;

use aoc2021\Day07\Day07;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day07Test  extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day07::class, new Day07());
    }

    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day07())->firstAndSecondTask($input, 'task1');

        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
        yield 'Dummy input first task' => [
            'input' => '16,1,2,0,4,2,7,1,2,14',
            'expected' => 37
        ];

        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day07.txt')),
            'expected' => 336131
        ];
    }

    /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day07())->firstAndSecondTask($input, 'task2');

        self::assertEquals($expected, $actual);
    }

    public function provideInputSecondTask(): Generator
    {

        yield 'Dummy input' => [
            'input' => '16,1,2,0,4,2,7,1,2,14',
            'expected' => 168
        ];

        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day07.txt')),
            'expected' => 92676646
        ];
    }
}

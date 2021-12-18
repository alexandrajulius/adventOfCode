<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2021Test\Day13Test;

use aoc2021\Day13\Day13;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day13Test extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day13::class, new Day13());
    }

    /**
     * @dataProvider provideInputFirstTask
     */
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day13())->firstTask($input);

        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {

        yield 'First dummy input fold on y axis' => [
            'input' => '6,10
0,14
9,10
0,3
10,4
4,11
6,0
6,12
4,1
0,13
10,12
3,4
3,0
8,4
1,10
2,14
8,10
9,0

fold along y=7',
            'expected' => 17
        ];

        yield 'First dummy input fold on x axis' => [
            'input' => '1,1
4,1
3,2

fold along x=2',
            'expected' => 3
        ];

        yield 'First dummy input fold on x axis next try' => [
            'input' => '4,0
1,2
1,3
5,3
0,5
1,5
2,5
4,5
5,5
6,5
6,6

fold along x=3',
            'expected' => 7
        ];

        yield 'First dummy input fold on x axis uneven amount of columns' => [
            'input' => '1,1
4,1
3,2
5,1

fold along x=3',
            'expected' => 2
        ];

        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day13.txt')),
            'expected' => 602
        ];
    }

}

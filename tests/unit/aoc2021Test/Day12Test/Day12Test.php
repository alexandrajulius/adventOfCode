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
        $actual = (new Day12())->task($input, 'firstTask');

        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {

        yield 'First dummy input' => [
            'input' => 'start-A
start-b
A-c
A-b
b-d
A-end
b-end',
            'expected' => 10
        ];

        yield 'Second dummy input' => [
            'input' => 'dc-end
HN-start
start-kj
dc-start
dc-HN
LN-dc
HN-end
kj-sa
kj-HN
kj-dc',
            'expected' => 19
        ];

        yield 'Third dummy input' => [
            'input' => 'fs-end
he-DX
fs-he
start-DX
pj-DX
end-zg
zg-sl
zg-pj
pj-he
RW-he
fs-DX
pj-RW
zg-RW
start-pj
he-WI
zg-he
pj-fs
start-RW',
            'expected' => 226
        ];

        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day12.txt')),
            'expected' => 4549
        ];
    }

    /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day12())->task($input, 'secondTask');

        self::assertEquals($expected, $actual);
    }

    public function provideInputSecondTask(): Generator
    {
        yield 'First dummy input' => [
            'input' => 'start-A
start-b
A-c
A-b
b-d
A-end
b-end',
            'expected' => 36
        ];
/*
        yield 'Second dummy input' => [
            'input' => 'dc-end
HN-start
start-kj
dc-start
dc-HN
LN-dc
HN-end
kj-sa
kj-HN
kj-dc',
            'expected' => 103
        ];

        yield 'Third dummy input' => [
            'input' => 'fs-end
he-DX
fs-he
start-DX
pj-DX
end-zg
zg-sl
zg-pj
pj-he
RW-he
fs-DX
pj-RW
zg-RW
start-pj
he-WI
zg-he
pj-fs
start-RW',
            'expected' => 3509
        ];
        */
/*
        yield 'For input final' => [
            'input' => trim(file_get_contents('./tests/fixtures/aoc2021/day12.txt')),
            'expected' => 4549
        ];
*/
    }
}

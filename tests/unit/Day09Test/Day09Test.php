<?php

declare(strict_types=1);

namespace Tests\unit\Day06Test;

use Day09\Day09;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day09Test extends TestCase
{
    // Find Encryption Weakness
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day09::class, new Day09());
    }

    /**
     * @dataProvider provideNumbersAndRangeSecondPuzzle
     */
    public function testFindsContiguousSetOfInvalidNumbers(string $input, int $range, int $expected): void
    {
        $actual = (new Day09())->findContiguousSetOfInvalidNumbers($input, $range);

        self::assertEquals($expected, $actual);
    }

    public function provideNumbersAndRangeSecondPuzzle(): Generator
    {
        yield 'For input a' => [
            'input' => '35
20
15
25
47
40
62
55
65
95
102
117
150
182
127
219
299
277
309
576',
            'range' => 5,
            'inValidNo' => 62
        ];

        yield 'For input final' => [
            'input' => file_get_contents('./tests/fixtures/day09.txt'),
            'range' => 25,
            'inValidNo' => 70672245
        ];
    }

    /**
     * @dataProvider provideNumbersAndRangeFirstPuzzle
     */
    public function testFindsFirstInvalidNumber(string $input, int $range, int $expected): void
    {
        $actual = (new Day09())->findFirstInvalidNumber($input, $range);

        self::assertEquals($expected, $actual);
    }

    public function provideNumbersAndRangeFirstPuzzle(): Generator
    {
        yield 'For input a' => [
            'input' => '35
20
15
25
47
40
62
55
65
95
102
117
150
182
127
219
299
277
309
576',
            'range' => 5,
            'inValidNo' => 127
        ];

        yield 'For input final' => [
            'input' => file_get_contents('./tests/fixtures/day09.txt'),
            'range' => 25,
            'inValidNo' => 552655238
        ];
    }
}
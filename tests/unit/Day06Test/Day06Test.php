<?php

declare(strict_types=1);

namespace Tests\unit\Day06Test;

use Day06\Day06;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day06Test extends TestCase
{
    // Customs Declaration
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day06::class, new Day06());
    }

    /**
     * @dataProvider provideAnswersPerGroup
     */
    public function testGetsAmountOfCommonAnswers(array $input, int $expected): void
    {
        $actual = (new Day06())->getAmountOfCommonYesAnswersPerGroup($input);

        self::assertEquals($expected, $actual);
    }

    public function provideAnswersPerGroup(): Generator
    {
        yield 'For answers a' => [
            'input' => ['ab', 'ac'],
            'result' => 1
        ];

        yield 'For answers b' => [
            'input' => ['abc'],
            'result' => 3
        ];

        yield 'For answers c' => [
            'input' => ['a', 'b', 'c'],
            'result' => 0
        ];

        yield 'For answers d' => [
            'input' => ['a', 'a', 'a', 'a'],
            'result' => 1
        ];

        yield 'For answers e' => [
            'input' => ['b'],
            'result' => 1
        ];
    }

    /**
     * @dataProvider provideGroupAnswersCommon
     */
    public function testGetsAmountOfUniqueAnswers(string $input, int $expected): void
    {
        $actual = (new Day06())->getAmountOfCommonYesAnswers($input);

        self::assertEquals($expected, $actual);
    }

    public function provideGroupAnswersCommon(): Generator
    {
        yield 'For answers a' => [
            'input' => 'ab
ac

a
b
c

abc

a
a
a
a

b',
            'result' => 6
        ];

        yield 'For answers final' => [
            'input' => file_get_contents('./tests/fixtures/day06.txt'),
            'result' => 3235
        ];
    }

    /**
     * @dataProvider provideGroupAnswers
     */
    public function testGetsAmountOfAnswers(string $input, int $expected): void
    {
        $actual = (new Day06())->getAmountOfYesAnswers($input);

        self::assertEquals($expected, $actual);
    }

    public function provideGroupAnswers(): Generator
    {
        yield 'For answers a' => [
            'input' => 'ab
ac

a
b
c

abc

a
a
a
a

b',
            'result' => 11
        ];

        yield 'For answers final' => [
            'input' => file_get_contents('./tests/fixtures/day06.txt'),
            'result' => 6587
        ];
    }
}
<?php

declare(strict_types=1);

namespace Tests\unit\Day05Test;

use Day05\Day05;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day05Test extends TestCase
{
    // Boarding Passes
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day05::class, new Day05());
    }

    /**
     * @dataProvider provideBoardingPass
     */
    public function testEncodesBoardingPassRow(string $boardingPass, int $expected): void
    {
        $actual = (new Day05())->findSeat($boardingPass);

        self::assertEquals($expected, $actual);
    }

    public function provideBoardingPass(): Generator
    {
        yield 'Boarding Pass a' => [
            'rowFragment' => 'FBFBBFFRLR',
            'row' => 357
        ];

        yield 'Boarding Pass b' => [
            'rowFragment' => 'BFFFBBFRRR',
            'row' => 567
        ];

        yield 'Boarding Pass c' => [
            'rowFragment' => 'FFFBBBFRRR',
            'row' => 119
        ];

        yield 'Boarding Pass d' => [
            'rowFragment' => 'BBFFBBFRLL',
            'row' => 820
        ];
    }

    /**
     * @dataProvider provideBoardingPasses
     */
    public function testFindsHighestSeatId(string $boardingPasses, int $expected): void
    {
        $actual = (new Day05())->findHighestSeatId($boardingPasses);

        self::assertEquals($expected, $actual);
    }

    public function provideBoardingPasses(): Generator
    {
        yield 'Boarding Pass final' => [
            'boardingPasses' => file_get_contents('./tests/fixtures/day05.txt'),
            'row' => 848
        ];
    }

    /**
     * @dataProvider provideBoardingPassesForMyId
     */
    public function testFindsMySeatId(string $boardingPasses, int $expected): void
    {
        $actual = (new Day05())->findMySeatId($boardingPasses);

        self::assertEquals($expected, $actual);
    }

    public function provideBoardingPassesForMyId(): Generator
    {
        yield 'Boarding Pass final' => [
            'boardingPasses' => file_get_contents('./tests/fixtures/day05.txt'),
            'row' => 682
        ];
    }
}
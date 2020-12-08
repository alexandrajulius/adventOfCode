<?php

declare(strict_types=1);

namespace Tests\unit\Day06Test;

use Day08\Day08;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day08Test extends TestCase
{
    // Fix game console
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day08::class, new Day08());
    }

    /**
     * @dataProvider provideInstructionsToFix
     */
    public function testGetsLastAccValueFromFixedInstructions(string $instructions, int $expected): void
    {
        $actual = (new Day08())->getLastAccValueFromFixedInstructions($instructions);

        self::assertEquals($expected, $actual);
    }

    public function provideInstructionsToFix(): Generator
    {
        yield 'For instructions a' => [
            'instructions' => 'nop +0
acc +1
jmp +4
acc +3
jmp -3
acc -99
acc +1
jmp -4
acc +6',
            'lastAccValue' => 8
        ];

        yield 'For instructions final' => [
            'instructions' => file_get_contents('./tests/fixtures/day08.txt'),
            'lastAccValue' => 1160
        ];
    }

    /**
     * @dataProvider provideInstructions
     */
    public function testGetsLastAccValue(string $instructions, int $expected): void
    {
        $actual = (new Day08())->getLastAccValue($instructions);

        self::assertEquals($expected, $actual);
    }

    public function provideInstructions(): Generator
    {
        yield 'For instructions a' => [
            'instructions' => 'nop +0
acc +1
jmp +4
acc +3
jmp -3
acc -99
acc +1
jmp -4
acc +6',
            'lastAccValue' => 5
        ];

        yield 'For instructions final' => [
            'instructions' => file_get_contents('./tests/fixtures/day08.txt'),
            'lastAccValue' => 1451
        ];
    }
}
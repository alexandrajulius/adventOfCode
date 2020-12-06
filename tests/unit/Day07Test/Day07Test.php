<?php

declare(strict_types=1);

namespace Tests\unit\Day06Test;

use Day07\Day07;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day07Test extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day07::class, new Day07());
    }

    /**
     * @dataProvider provideStuffData
     */
    public function testGetsStuff(string $input, int $expected): void
    {
        $actual = (new Day07())->getStuff($input);

        self::assertEquals($expected, $actual);
    }

    public function provideStuffData(): Generator
    {
        yield 'For answers a' => [
            'input' => '',
            'result' => 1
        ];
    }
}
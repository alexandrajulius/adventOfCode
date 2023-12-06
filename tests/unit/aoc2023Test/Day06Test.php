<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2023Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2023\Day06\Day06;

final class Day06Test extends TestCase
{
    /**
     * @dataProvider provideInputFirstTask
     */
     public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day06)->firstTask($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputFirstTask(): Generator
    {
        
        yield 'Sample input' => [
            'input' => 'Time:      7  15   30
            Distance:  9  40  200',
            'expected' => 288
        ];
        
        yield 'Final input' => [
            'input' => 'Time:        40     70     98     79
Distance:   215   1051   2147   1005',
            'expected' => 1084752
        ];    
    }

    /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day06)->secondTask($input);
    
        self::assertEquals($expected, $actual);
    }

    public static function provideInputSecondTask(): Generator
    {
        
        yield 'Sample input' => [
            'input' => 'Time:      7  15   30
            Distance:  9  40  200',
            'expected' => 71503
        ];
        
        yield 'Final input' => [
            'input' => 'Time:        40     70     98     79
Distance:   215   1051   2147   1005',
            'expected' => 28228952
        ]; 
        
    }

}



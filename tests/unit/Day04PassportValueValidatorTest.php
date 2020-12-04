<?php

declare(strict_types=1);

namespace Tests\unit;
use Generator;
use Day04PassportValueValidator;
use PHPUnit\Framework\TestCase;

final class Day04PassportValueValidatorTest extends TestCase
{
    /**
     * @dataProvider provideSetOfPassport
     */
    public function testValidatesPassport(array $input, bool $expected): void
    {
        $actual = (new Day04PassportValueValidator())->isValidPassportValues($input);

        self::assertEquals($expected, $actual);
    }

    public function provideSetOfPassport(): Generator
    {
        yield 'PassportData a' => [
            'input' => [
                'hcl' => '#123abc',
                'hgt' => '157cm',
                'byr' => '2002',
                'pid' => '000000001',
                'iyr' => '2010',
                'ecl' => 'brn',
                'eyr' => '2030'
            ],
            'result' => true
        ];

        yield 'PassportData b' => [
            'input' => [
                'hcl' => '#123abz',
                'hgt' => '157',
                'byr' => '2003',
                'pid' => '0123456789',
                'iyr' => '2021',
                'ecl' => 'wat',
                'eyr' => '2034'
            ],
            'result' => false
        ];
    }

    /**
     * @dataProvider providePid
     */
    public function testValidatesPid(string $input, bool $expected): void
    {
        $actual = (new Day04PassportValueValidator())->isValidPid($input);

        self::assertEquals($expected, $actual);
    }

    public function providePid(): Generator
    {
        yield 'PassportData a' => [
            'input' => '000000001',
            'result' => true
        ];

        yield 'PassportData b' => [
            'input' => '0123456789',
            'result' => false
        ];

        yield 'PassportData c' => [
            'input' => '120354938',
            'result' => true
        ];
    }

    /**
     * @dataProvider provideEyeColor
     */
    public function testValidatesEyeColor(string $input, bool $expected): void
    {
        $actual = (new Day04PassportValueValidator())->isValidEyeColor($input);

        self::assertEquals($expected, $actual);
    }

    public function provideEyeColor(): Generator
    {
        yield 'PassportData a' => [
            'input' => 'brn',
            'result' => true
        ];

        yield 'PassportData b' => [
            'input' => 'wat',
            'result' => false
        ];
    }

    /**
     * @dataProvider provideHairColor
     */
    public function testValidatesHairColor(string $input, bool $expected): void
    {
        $actual = (new Day04PassportValueValidator())->isValidHairColor($input);

        self::assertEquals($expected, $actual);
    }

    public function provideHairColor(): Generator
    {
        yield 'PassportData a' => [
            'input' => '#123abc',
            'result' => true
        ];

        yield 'PassportData b' => [
            'input' => '#123abz',
            'result' => false
        ];

        yield 'PassportData c' => [
            'input' => '123abc',
            'result' => false
        ];
    }

    /**
     * @dataProvider provideHeight
     */
    public function testValidatesHeight(string $input, bool $expected): void
    {
        $actual = (new Day04PassportValueValidator())->isValidHeight($input);

        self::assertEquals($expected, $actual);
    }

    public function provideHeight(): Generator
    {
        yield 'PassportData a' => [
            'input' => '60in',
            'result' => true
        ];

        yield 'PassportData b' => [
            'input' => '190cm',
            'result' => true
        ];

        yield 'PassportData c' => [
            'input' => '190in',
            'result' => false
        ];

        yield 'PassportData d' => [
            'input' => '190',
            'result' => false
        ];
    }

    /**
     * @dataProvider provideBirthyear
     */
    public function testValidatesBirthyear(int $input, bool $expected): void
    {
        $actual = (new Day04PassportValueValidator())->isValidBirthYear($input);

        self::assertEquals($expected, $actual);
    }

    public function provideBirthyear(): Generator
    {
        yield 'PassportData a' => [
            'input' => 2002,
            'result' => true
        ];

        yield 'PassportData b' => [
            'input' => 1920,
            'result' => true
        ];

        yield 'PassportData c' => [
            'input' => 2003,
            'result' => false
        ];

        yield 'PassportData d' => [
            'input' => 200,
            'result' => false
        ];
    }
}
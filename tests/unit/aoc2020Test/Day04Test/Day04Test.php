<?php

declare(strict_types=1);

namespace Tests\unit\aoc2020Test\Day04Test;

use aoc2020\Day04\Day04;
use aoc2020\Day04\Day04PassportValueValidator;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class Day04Test extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        Assert::assertInstanceOf(Day04::class, new Day04(new Day04PassportValueValidator()));
    }

    /**
     * @dataProvider provideInputData
     */
    public function testConvertsInput(string $input, array $expected): void
    {
        $actual = (new Day04(new Day04PassportValueValidator()))->convertInputData($input);

        self::assertEquals($expected, $actual);
    }

    public function provideInputData(): Generator
    {
        yield 'PassportData a' => [
            'input' => 'ecl:gry pid:860033327 eyr:2020 hcl:#fffffd
byr:1937 iyr:2017 cid:147 hgt:183cm

iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884
hcl:#cfa07d byr:1929

hcl:#ae17e1 iyr:2013
eyr:2024
ecl:brn pid:760753108 byr:1931
hgt:179cm

hcl:#cfa07d eyr:2025 pid:166559648
iyr:2011 ecl:brn hgt:59in',
            'result' => [
                ['ecl:gry pid:860033327 eyr:2020 hcl:#fffffd byr:1937 iyr:2017 cid:147 hgt:183cm'],
                ['iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884 hcl:#cfa07d byr:1929'],
                ['hcl:#ae17e1 iyr:2013 eyr:2024 ecl:brn pid:760753108 byr:1931 hgt:179cm'],
                ['hcl:#cfa07d eyr:2025 pid:166559648 iyr:2011 ecl:brn hgt:59in']
            ]
        ];

        yield 'PassportData b' => [
            'input' => 'iyr:2019 ecl:#19fef5 pid:2080468234
eyr:2008 hgt:72 hcl:e14dfe byr:1980

ecl:gry pid:860033327
eyr:2020 hcl:#fffffd byr:1937 iyr:2017
cid:147 hgt:183cm',
            'result' => [
                ['iyr:2019 ecl:#19fef5 pid:2080468234 eyr:2008 hgt:72 hcl:e14dfe byr:1980'],
                ['ecl:gry pid:860033327 eyr:2020 hcl:#fffffd byr:1937 iyr:2017 cid:147 hgt:183cm']
            ]
        ];
    }

    /**
     * @dataProvider providePassportData
     */
    public function testValidatesPassport(string $input, int $expected): void
    {
        $actual = (new Day04(new Day04PassportValueValidator()))->getAmountOfValidPassports($input);

        self::assertEquals($expected, $actual);
    }

    public function providePassportData(): Generator
    {
        yield 'PassportData a' => [
            'input' => 'ecl:gry pid:860033327 eyr:2020 hcl:#fffffd byr:1937 iyr:2017 cid:147 hgt:183cm',
            'result' => 1
        ];

        yield 'PassportData b' => [
            'input' => 'iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884 hcl:#cfa07d byr:1929',
            'result' => 0
        ];

        yield 'PassportData c' => [
            'input' => 'asd:asdf hcl:#ae17e1 iyr:2013 eyr:2024 ecl:brn pid:760753108 byr:1931 hgt:179cm',
            'result' => 0
        ];

         yield 'PassportData d' => [
            'input' => 'hcl:#cfa07d eyr:2025 pid:166559648 iyr:2011 ecl:brn hgt:59in',
            'result' => 0
        ];

        yield 'PassportData e' => [
            'input' => 'ecl:gry pid:860033327 eyr:2020 hcl:#fffffd
byr:1937 iyr:2017 cid:147 hgt:183cm

iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884
hcl:#cfa07d byr:1929

hcl:#ae17e1 iyr:2013
eyr:2024
ecl:brn pid:760753108 byr:1931
hgt:179cm

hcl:#cfa07d eyr:2025 pid:166559648
iyr:2011 ecl:brn hgt:59in',
            'result' => 2
        ];

        yield 'PassportData final' => [
            'input' => file_get_contents('./tests/fixtures/aoc2020/day04.txt'),
            'result' => 219
        ];
    }

    /**
     * @dataProvider providePassportDataIncludingValues
     */
    public function testValidatesPassportIncludingValues(string $input, int $expected): void
    {
        $actual = (new Day04(new Day04PassportValueValidator()))->getAmountOfValidPassportsIncludingValues($input);

        self::assertEquals($expected, $actual);
    }

    public function providePassportDataIncludingValues(): Generator
    {
        yield 'PassportData a' => [
            'input' => 'ecl:gry pid:860033327 eyr:2020 hcl:#fffffd byr:1937 iyr:2017 cid:147 hgt:183cm',
            'result' => 1
        ];

        yield 'PassportData b' => [
            'input' => 'iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884 hcl:#cfa07d byr:1929',
            'result' => 0
        ];

        yield 'PassportData c' => [
            'input' => 'asd:asdf hcl:#ae17e1 iyr:2013 eyr:2024 ecl:brn pid:760753108 byr:1931 hgt:179cm',
            'result' => 0
        ];

        yield 'PassportData d' => [
            'input' => 'hcl:#cfa07d eyr:2025 pid:166559648 iyr:2011 ecl:brn hgt:59in',
            'result' => 0
        ];

        yield 'PassportData e' => [
            'input' => 'ecl:gry pid:860033327 eyr:2020 hcl:#fffffd
byr:1937 iyr:2017 cid:147 hgt:183cm

iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884
hcl:#cfa07d byr:1929

hcl:#ae17e1 iyr:2013
eyr:2024
ecl:brn pid:760753108 byr:1931
hgt:179cm

hcl:#cfa07d eyr:2025 pid:166559648
iyr:2011 ecl:brn hgt:59in',
            'result' => 2
        ];

        yield 'PassportData final' => [
            'input' => file_get_contents('./tests/fixtures/aoc2020/day04.txt'),
            'result' => 127
        ];
    }
}

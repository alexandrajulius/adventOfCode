<?php

declare(strict_types=1);

namespace aoc2020\Day04;

use Day04\Day04PassportValueValidator;

final class Day04
{
    // Passport Validation
    private const CID = 'cid';

    private $passportValueValidator;

    public function __construct(Day04PassportValueValidator $passportValueValidator)
    {
        $this->passportValueValidator = $passportValueValidator;
    }

    public function getAmountOfValidPassportsIncludingValues(string $rawPassports): int
    {
        $passports = $this->convertInputData($rawPassports);
        $count = 0;

        foreach ($passports as $passport) {
            $fields = explode(' ', $passport[0]);
            $validationInput = [];
            foreach ($fields as $field) {
                $field = explode(':', $field);
                if ($field[0] !== self::CID) {
                    $validationInput[$field[0]] = $field[1];
                }
            }
            if ($this->isValidPassportKeys($validationInput)) {
                if ($this->passportValueValidator->isValidPassportValues($validationInput)) {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function getAmountOfValidPassports(string $rawPassports): int
    {
        $passports = $this->convertInputData($rawPassports);
        $count = 0;

        foreach ($passports as $passport) {
            $fields = explode(' ', $passport[0]);
            $validationInput = [];
            foreach ($fields as $field) {
                $field = explode(':', $field);
                if ($field[0] !== self::CID) {
                    $validationInput[$field[0]] = $field[1];
                }
            }
            if ($this->isValidPassportKeys($validationInput)) {
                $count++;
            }
        }

        return $count;
    }

    public function convertInputData(string $rawInput): array
    {
        $passPorts = explode("\n\n", $rawInput);

        $output = [];
        foreach ($passPorts as $passPort) {
            $output[] = [str_replace("\n", ' ', $passPort)];
        }

        return $output;
    }

    public function isValidPassportKeys(array $passportInput): bool
    {
        $preSortedFields = ['byr', 'ecl', 'eyr', 'hcl', 'hgt', 'iyr', 'pid'];

        $passportFields = array_keys($passportInput);
        array_multisort($passportFields);

        return $preSortedFields === $passportFields;
    }

}

<?php

declare(strict_types=1);

final class Day04
{
    private const CID = 'cid';

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
            $count = ($this->isValidPassport($validationInput)) == true ? ($count + 1) : $count;
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

    public function isValidPassport(array $passportInput): bool
    {
        $preSortedFields = ['byr', 'ecl', 'eyr', 'hcl', 'hgt', 'iyr', 'pid'];

        $passportFields = array_keys($passportInput);
        array_multisort($passportFields);

        return $preSortedFields === $passportFields;
    }
}
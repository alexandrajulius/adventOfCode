<?php

declare(strict_types=1);

namespace Day04;

final class Day04PassportValueValidator
{
    public function isValidPassportValues(array $passportInput): bool
    {
        foreach ($passportInput as $key => $value) {
            if ($key == 'byr') {
                if (!$this->isValidBirthYear((int)$value)) {
                    return false;
                }
            }

            if ($key == 'iyr') {
                if (!$this->isValidIssueYear((int)$value)) {
                    return false;
                }
            }

            if ($key == 'eyr') {
                if (!$this->isValidExpirationYear((int)$value)) {
                    return false;
                }
            }

            if ($key == 'hgt') {
                if (!$this->isValidHeight($value)) {
                    return false;
                }
            }

            if ($key == 'hcl') {
                if (!$this->isValidHairColor($value)) {
                    return false;
                }
            }

            if ($key == 'ecl') {
                if (!$this->isValidEyeColor($value)) {
                    return false;
                }
            }

            if ($key == 'pid') {
                if (!$this->isValidPid($value)) {
                    return false;
                }
            }
        }

        return true;
    }

    #four digits; at least 1920 and at most 2002
    public function isValidBirthYear(int $birthYear): bool
    {
        if ($birthYear < 1920 || $birthYear > 2002) {
            return false;
        }

        return true;
    }

    #four digits; at least 2010 and at most 2020
    private function isValidIssueYear(int $issueYear): bool
    {
        if ($issueYear < 2010 || $issueYear > 2020) {
            return false;
        }

        return true;
    }

    #four digits; at least 2020 and at most 2030
    private function isValidExpirationYear(int $expirationYear): bool
    {
        if ($expirationYear < 2020 || $expirationYear > 2030) {
            return false;
        }

        return true;
    }

    #hgt (Height) - a number followed by either cm or in:
    #If cm, the number must be at least 150 and at most 193.
    #If in, the number must be at least 59 and at most 76.
    public function isValidHeight(string $height): bool
    {

        if ((strpos($height, 'cm') === false) && (strpos($height, 'in') === false)) {
            return false;
        }

        if ((strpos($height, 'cm') !== false)) {
            $number = strstr($height, 'cm', true);
            if ((int)$number < 150 || (int)$number > 193 ) {
                return false;
            }
        }

        if ((strpos($height, 'in') !== false)) {
            $number = strstr($height, 'in', true);
            if ($number < 59 || $number > 76 ) {
                return false;
            }
        }

        return true;
    }

    #a # followed by exactly six characters 0-9 or a-f.
    public function isValidHairColor(string $height): bool
    {
        $pattern = '/^#[a-f0-9]{6}/';
        preg_match($pattern, $height, $matches);
        if (empty($matches)) {
            return false;
        }

        return true;
    }

    #ecl (Eye Color) - exactly one of: amb blu brn gry grn hzl oth.
    public function isValidEyeColor(string $eyeColor): bool
    {
        $validEyeColors = ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'];

        if (!in_array($eyeColor, $validEyeColors)) {
            return false;
        }

        return true;
    }

    #pid (Passport ID) - a nine-digit number, including leading zeroes.
    public function isValidPid(string $pid): bool
    {
        preg_match('/^\d{9}$/', $pid, $matches);
        if (empty($matches)) {
            return false;
        }

        return true;
    }
}
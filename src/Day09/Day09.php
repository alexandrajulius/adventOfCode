<?php

declare(strict_types=1);

namespace Day09;

final class Day09
{
    // Find Encryption Weakness
    public function findContiguousSetOfInvalidNumbers(string $rawInput, int $range): int
    {
        $numbers = $this->convertInput($rawInput);

        $validSet = [];
        for ($i = $range; $i <= (count($numbers) - 1); $i++) {
            $preamble = array_slice($numbers, $i - $range, $range);

            if (!$this->isValidNumber($numbers[$i], $preamble)) {
                $validSet = $this->getValidContiguousSet($numbers[$i], $numbers);
                sort($validSet);
            }
        }

        return $validSet[0] + end($validSet);
    }

    private function getValidContiguousSet(int $sum, array $numbers): array
    {
        for ($i = 2; $i <= count($numbers); $i++) {
            for ($j = 0; $j <= count($numbers); $j++) {
                if (array_sum(array_slice($numbers, $j, $i)) == $sum) {
                    return array_slice($numbers, $j, $i);
                }
            }
        }

        return [];
    }

    public function findFirstInvalidNumber(string $rawInput, int $range): int
    {
        $numbers = $this->convertInput($rawInput);

        for ($i = $range; $i <= count($numbers); $i++) {
            $preamble = array_slice($numbers, $i - $range, $range);

            if (!$this->isValidNumber($numbers[$i], $preamble)) {
                return $numbers[$i];
            }
        }

        return 0;
    }

    private function isValidNumber(int $sum, array $preamble): bool
    {
        foreach ($preamble as $number) {
            if (in_array(($sum - $number), $preamble)) {
                return true;
            }
        }

        return false;
    }

    private function convertInput(string $rawInput): array
    {
        return array_map('intval', explode("\n", $rawInput));
    }
}
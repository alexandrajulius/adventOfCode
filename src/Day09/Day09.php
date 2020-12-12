<?php

declare(strict_types=1);

namespace Day09;

final class Day09
{
    public function findFirstInvalidNo(string $rawInput, int $range): int
    {
        $numbers = $this->convertInput($rawInput);

        for ($i = $range; $i <= count($numbers); $i++) {
            $preamble = array_slice($numbers, $i - $range, $range);

            if (!$this->isValidNumber((int)$numbers[$i], $preamble)) {
                return (int)$numbers[$i];
            }
        }

        return 1;
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
        return explode("\n", $rawInput);
    }
}
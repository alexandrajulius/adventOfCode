<?php

declare(strict_types=1);

namespace aoc2020\Day01;

final class Day01
{
    private const CURRENT_YEAR = 2020;

    // Expenses
    public function findProductOfThree(array $expenses): int
    {
        $output = 0;

        for ($i = 0; $i < count($expenses); $i++) {
            for ($j = 0; $j < count($expenses); $j++) {
                $tempResult = self::CURRENT_YEAR - $expenses[$i] - $expenses[$j];
                if ($expenses[$i] + $expenses[$j] < self::CURRENT_YEAR) {
                    if (in_array($tempResult, $expenses)) {
                        return $expenses[$i] * $expenses[$j] * $tempResult;
                    }
                }
            }
        }

        return $output;
    }

    public function findProductOfTwo(array $expenses): int
    {
        $output = 0;
        for ($i = 0; $i < count($expenses); $i++) {
            $tempResult = self::CURRENT_YEAR - $expenses[$i];
            if (in_array($tempResult, $expenses)) {
                return $expenses[$i] * $tempResult;
            }
        }

        return $output;
    }


}

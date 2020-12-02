<?php

declare(strict_types=1);

final class Expenses
{
    public function findProductOfThree(int $result, array $expenses): int
    {
        $output = 0;

        for ($i = 0; $i < count($expenses); $i++) {
            for ($j = 0; $j < count($expenses); $j++) {
                $tempResult = $result - $expenses[$i] - $expenses[$j];
                if ($expenses[$i] + $expenses[$j] < $result) {
                    if (in_array($tempResult, $expenses)) {
                        return $expenses[$i] * $expenses[$j] * $tempResult;
                    }
                }
            }
        }

        return $output;
    }

    public function findProductOfTwo(int $result, array $expenses): int
    {
        $output = 0;
        for ($i = 0; $i < count($expenses); $i++) {
            $tempResult = $result - $expenses[$i];
            if (in_array($tempResult, $expenses)) {
                return $expenses[$i] * $tempResult;
            }
        }

        return $output;
    }


}
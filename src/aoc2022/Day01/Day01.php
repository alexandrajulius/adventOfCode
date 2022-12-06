<?php

declare(strict_types = 1);

namespace aoc2022\Day01;

final class Day01
{
    public function firstTask(string $input): int
    {
        $caloriesPerElf = $this->getCaloriesPerElf($input);

        return max($caloriesPerElf);
    }

    public function secondTask(string $input): int
    {
        $caloriesPerElf = $this->getCaloriesPerElf($input);
        rsort($caloriesPerElf);

        return $caloriesPerElf[0] + $caloriesPerElf[1] + $caloriesPerElf[2];
    }

    private function getCaloriesPerElf(string $input):  array
    {
        $trimmed = preg_replace('/[ ]{2,}|[\t]/', '', trim($input));
        $items = array_map('intval', explode(PHP_EOL, $trimmed));
  
        $sums = [];
        $index = 0; 
        $sums[$index] = 0;
        foreach ($items as $item) {
            if ($item !== 0) {
                $sums[$index] += $item;
            } else {
                $index++; 
                $sums[$index] = 0;
            }           
        }

        return $sums;
    }
}

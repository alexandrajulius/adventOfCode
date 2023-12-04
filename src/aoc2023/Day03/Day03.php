<?php

declare(strict_types = 1);

namespace aoc2023\Day03;

final class Day03
{
    public function firstTask(string $input): int
    {
        $matrix = Matrix::from($this->toArray($input));
        $partNumbers = $matrix->getPartNumbers();

        return array_sum($partNumbers);
    }

    public function secondTask(string $input): int
    {
        $matrix = Matrix::from($this->toArray($input));
        $asterisks = $matrix->getGearRatio();
        $ratios = [];
        foreach ($asterisks as $asterisk) {
            if ($asterisk->adjacentPartNumbersCount === 2) {
                $ratios[] = $asterisk->adjacentPartNumbers[0] * $asterisk->adjacentPartNumbers[1];
            }
        }

        return array_sum($ratios);
    }

    /**
     * @return string[]|bool
     */
    private function toArray(string $input): array
    {
        return explode(PHP_EOL, preg_replace('/[ ]{2,}|[\t]/', '', trim($input)));
    }
}
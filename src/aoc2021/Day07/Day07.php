<?php

declare(strict_types = 1);

namespace aoc2021\Day07;

final class Day07
{
    public function firstAndSecondTask(string $input, string $task): int
    {
        $positions = $this->getInitPositions($input);
        $fuelExpenses = [];
        foreach (range(1, max($positions)) as $key => $pos) {
            if ($task === 'task1') {
                $fuelExpenses[] = $this->getAlignedPositions($positions, $pos);
            }
            if ($task === 'task2') {
                $fuelExpenses[] = $this->getAlignedPositionsCorrectedFuel($positions, $key);
            }
        }

        return min($fuelExpenses);
    }

    public function getAlignedPositionsCorrectedFuel(array $list, int $horizon): int
    {
        $fuel = 0;
        foreach ($list as $position) {
            $diff = abs($position - $horizon);
            $range = range(0, $diff, 1);
            $fuel += array_sum($range);
          }

        return $fuel;
    }

    public function getAlignedPositions(array $list, int $horizon): int
    {
        $fuel = 0;
        foreach ($list as $position) {
            $fuel += abs($position - $horizon);
        }

        return $fuel;
    }

    /**
     * @return int[]
     */
    private function getInitPositions(string $input): array
    {
        $positions = explode(',', $input);
        return array_map(function(string $pos): int {
            return (int)$pos;
        }, $positions);
    }
}

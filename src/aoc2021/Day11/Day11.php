<?php

declare(strict_types = 1);

namespace aoc2021\Day11;

final class Day11
{
    public function firstTask(string $input, int $steps): int
    {
        $octopusGrid = Grid::create($input);

        $flashCount = 0;
        for ($i = $steps; $i > 0; $i--) {
            $flashCount += $octopusGrid->simulateStep();
        }

        return $flashCount;
    }

    public function secondTask(string $input): int
    {
        $octopusGrid = Grid::create($input);

        $i = 1;
        while(true){
            $flashCount = $octopusGrid->simulateStep();
            if ($flashCount === $octopusGrid->getSize()) {
                return $i;
            }
            $i++;
        }

    }
}

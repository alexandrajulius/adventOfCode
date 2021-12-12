<?php

declare(strict_types = 1);

namespace aoc2021\Day11;

final class Day11
{
    public const STEPS = 1;

    public function firstTask(string $input): int
    {
        $octopusGrid = Grid::create($input);

        $flashCount = 0;
        for ($i = self::STEPS; $i >= 0; $i--) {
            $flashCount += $octopusGrid->simulateStep($i, 0);
        }

        return $flashCount;
    }
}

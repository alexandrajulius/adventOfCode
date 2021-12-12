<?php

declare(strict_types = 1);

namespace aoc2021\Day11;

final class Grid
{
    public array $rows = [];

    public static function create(string $input): Grid
    {
        $lanes = explode("\n", $input);

        $grid = new self();
        foreach($lanes as $yIndex => $lane) {
            $laneArr = str_split($lane, 1);
            $row = [];
            foreach ($laneArr as $xIndex => $value) {
                $row[] = new Octopus([$yIndex, $xIndex, (int)$value]);
            }
            $grid->addRow($row);
        }

        return $grid;
    }

    private function addRow(array $row): void
    {
        $this->rows[] = $row;
    }

    public function simulateStep(int $flashCount = 0): int
    {
        foreach ($this->rows as $row) {
            foreach ($row as $octopus) {
                $flashCount = $this->step($octopus, $flashCount);
            }
        }
        return $flashCount;
    }

    private function step(Octopus $octopus, $flashCount): int
    {
        if ($octopus->getEnergyLevel() < 9) {
            $octopus->incrementEnergyLevel();
        }

        if ($octopus->getEnergyLevel() === 9) {
            $octopus->flash();
            $flashCount++;
            $neighbors = $this->getAdjacentOctopuses($octopus);
            foreach ($neighbors as $neighbor) {
                $flashCount = $this->step($neighbor, $flashCount);
            }
        }

        return $flashCount;
    }

    public function getAdjacentOctopuses(Octopus $octopus): array
    {
        $adjacentDiffs = [
            [1, 0], [-1, 0], [0, 1], [0, -1],
            [1, 1], [-1, 1], [1, -1], [-1, -1]
        ];

        $adjacentOctopuses = [];
        foreach ($adjacentDiffs as [$y, $x]) {
            $adjacentOctopuses[] = $this->getOctopusAt($octopus->getY() + $y, $octopus->getX() + $x);
        }

        return $adjacentOctopuses;
    }

    public function getOctopusAt(int $y, int $x): Octopus
    {
        if (isset($this->rows[$y][$x])) {
            return $this->rows[$y][$x];
        }

        return new Octopus([$y, $x, 9]);
    }
}

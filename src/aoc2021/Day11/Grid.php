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
}

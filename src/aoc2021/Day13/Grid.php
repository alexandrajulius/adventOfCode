<?php

declare(strict_types = 1);

namespace aoc2021\Day13;

final class Grid
{
    public array $rows = [];
    public int $gridSizeY = 0;
    public int $gridSizeX = 0;
    public array $gridPartitionOne = [];
    public array $gridPartitionTwo = [];
    public bool $unevenPartitions = false;

    public static function create(string $input): Grid
    {
        $coordinates = explode("\n", $input);
        $grid = new self();
        $size = $grid->getInitSize($coordinates);
        $grid->init($size);
        foreach($coordinates as $coordinate) {
            $point = explode(',', $coordinate);
            $grid->setPointAt((int)$point[1], (int)$point[0], '#');
        }

        return $grid;
    }

    private function getInitSize(array $coordinates): array
    {
        $size['y'] = 0;
        $size['x'] = 0;
        foreach ($coordinates as $coordinate) {
            $coordinate = explode(',', $coordinate);
            if ($coordinate[1] > $size['y']) {
                $size['y'] = (int)$coordinate[1];
            }
            if ($coordinate[0] > $size['x']) {
                $size['x'] = (int)$coordinate[0];
            }
        }

        return $size;
    }

    private function init(array $size): void
    {
        foreach (range(0, $size['y']) as $y) {
            foreach (range(0, $size['x']) as $x) {
                $this->rows[$y][$x] = '.';
            }
        }

        $this->setGridSize();
    }

    private function setGridSize(): void
    {
        $this->gridSizeY = count($this->rows) - 1;
        $this->gridSizeX = count($this->rows[0]) - 1;
    }

    private function setPointAt(int $y, int $x, string $value): void
    {
        $this->rows[$y][$x] = $value;
    }

    public function fold(Fold $fold): void
    {
        $this->gridPartitionOne = [];
        $this->gridPartitionTwo = [];

        if ($fold->axis === 'y') {
            $this->foldOnYAxis($fold);
            $this->mergeYPartitions();
        }

        if ($fold->axis === 'x') {
            $this->foldOnXAxis($fold);
            $this->mergeXPartitions();
        }

        $this->setGridSize();
    }

    private function foldOnYAxis(Fold $fold): void
    {
        foreach (range(0, $fold->value - 1) as $yIndex) {
            $this->gridPartitionOne[] = $this->rows[$yIndex];
        }

        foreach (range($fold->value + 1, $this->gridSizeY) as $yIndex) {
            $this->gridPartitionTwo[] = $this->rows[$yIndex];

      #      array_splice($this->rows[$yIndex], $yIndex, 1);

            unset($this->rows[$yIndex]);
        }

     #   array_splice($this->rows, $fold->value, 1);

        unset($this->rows[$fold->value]);
    }

    private function mergeYPartitions(): void
    {
        $this->gridPartitionTwo = array_reverse($this->gridPartitionTwo, false);
        $this->mergeValues();
    }

    private function foldOnXAxis(Fold $fold): void
    {
        $unevenPartitions = $this->gridSizeX % $fold->value !== 0;
        foreach ($this->rows as $yIndex => $row) {
            $this->gridPartitionOne[] = array_slice($row, 0, $fold->value);
            $this->gridPartitionTwo[] = array_slice($row, -($this->gridSizeX - $fold->value), $this->gridSizeX - $fold->value);

            foreach (range($fold->value, $this->gridSizeX) as $index) {
             #   array_splice($row, $index, 1);

                unset($this->rows[$yIndex][$index]);
            }
        }

        if ($unevenPartitions) {
            foreach ($this->gridPartitionOne as &$row) {
                array_splice($row, 0, 1);
            #    unset($this->rows[0]);

            }
        }
    }

    private function mergeXPartitions(): void
    {
        foreach ($this->gridPartitionTwo as $rowKey => $row) {
            $this->gridPartitionTwo[$rowKey] = array_reverse($row, false);
        }

        $this->mergeValues();
    }

    private function mergeValues(): void
    {
        foreach ($this->gridPartitionOne as $rowKey => $partitionRow) {
            foreach ($partitionRow as $valueKey => $value) {
                if ($value === '#' || $this->gridPartitionTwo[$rowKey][$valueKey] === '#') {
                    $this->rows[$rowKey][$valueKey] = '#';
                } else {
                    $this->rows[$rowKey][$valueKey] = '.';
                }
            }
        }
    }

    public function countHashes(): int
    {
        $count = 0;
        foreach ($this->rows as $row) {
            $counts = array_count_values($row);
            if (isset($counts['#'])) {
                $count += $counts['#'];
            }
        }

        return $count;
    }
}

<?php

declare(strict_types = 1);

namespace aoc2021\Day09;

final class HeightMap
{
    public array $rows = [];

    public static function create(array $lanes): HeightMap
    {
        $heightmap = new self();
        foreach($lanes as $yIndex => $lane) {
            $laneArr = str_split($lane, 1);
            $row = [];
            foreach ($laneArr as $xIndex => $value) {
                $row[] = new Point([$yIndex, $xIndex, (int)$value]);
            }
            $heightmap->addRow($row);
        }

        return $heightmap;
    }

    public function getBasinSize(Point $point, int $count = 0, array &$seen = []): int
    {
        if (isset($seen[$point->hash()])) {
            return $count;
        }

        $seen[$point->hash()] = true;
        $count++;

        $coordinates = [
            [1, 0], [-1, 0], [0, 1], [0, -1]
        ];

        $nextPoints = [];
        foreach ($coordinates as [$y, $x]) {
            $nextPoint = $this->getPointAt($point->getY() + $y, $point->getX() + $x);
            if (($nextPoint->getValue() < 9) && !array_key_exists($nextPoint->hash(), $seen)) {
                $nextPoints[] = $nextPoint;
            }
        }

        foreach ($nextPoints as $nextPoint) {
            $count = $this->getBasinSize($nextPoint, $count, $seen);
        }

        return $count;
    }

    private function addRow(array $row): void
    {
        $this->rows[] = $row;
    }

    public function getLowestPoints(): array
    {
        $lowestPoints = [];
        foreach ($this->rows as $row) {
            foreach ($row as $point) {
                if ($this->isLeftHigher($point)
                && $this->isRightHigher($point)
                && $this->isLowerHigher($point)
                && $this->isUpperHigher($point)) {
                    $lowestPoints[] = $point;
                }

            }
        }

        return $lowestPoints;
    }

    private function isLeftHigher(Point $point): bool
    {
        if (!isset($this->rows[$point->getY()][$point->getX() - 1])) {
            return true;
        }

        $leftNeighbor = $this->rows[$point->getY()][$point->getX() - 1];

        return $leftNeighbor->getValue() > $point->getValue();
    }

    private function isRightHigher(Point $point): bool
    {
        if (!isset($this->rows[$point->getY()][$point->getX() + 1])) {
            return true;
        }

        $rightNeighbor = $this->rows[$point->getY()][$point->getX() + 1];

        return $rightNeighbor->getValue() > $point->getValue();
    }

    private function isLowerHigher(Point $point): bool
    {
        if (!isset($this->rows[$point->getY() + 1][$point->getX()])) {
            return true;
        }

        $lowerNeighbor = $this->rows[$point->getY() + 1][$point->getX()];

        return $lowerNeighbor->getValue() > $point->getValue();
    }

    private function isUpperHigher(Point $point): bool
    {
        if (!isset($this->rows[$point->getY() - 1][$point->getX()])) {
            return true;
        }

        $upperNeighbor = $this->rows[$point->getY() - 1][$point->getX()];

        return $upperNeighbor->getValue() > $point->getValue();
    }

    public function getPointAt(int $y, int $x): Point
    {
        if (isset($this->rows[$y][$x])) {
            return $this->rows[$y][$x];
        }

        return new Point([$y, $x, 9]);
    }
}

<?php

declare(strict_types = 1);

namespace aoc2021\Day05;

final class Diagram
{
    public array $rows = [];

    static function create(array $allCoordinates, string $task): Diagram
    {
        $diagram = new Diagram();
        foreach($allCoordinates as $coordinates) {
            $lineInput = [];
            foreach($coordinates as $coordinate) {
                $lineInput[] = explode(',', $coordinate);
            }
            if ($task === 'task1') {
                  $diagram->drawLine($lineInput[0], $lineInput[1]);
            }
            if ($task === 'task2') {
                $diagram->drawAllLines(new Point($lineInput[0]), new Point($lineInput[1]));
            }
        }

        return $diagram;
    }

    /**
     * @param array $lineInput
     * [
     *      [
     *          0 => x1
     *          1 => y1
     *      ],
     *      [
     *          0 => x2
     *          1 => y2
     *      ]
     * ]
     */
    public function drawLine(array $startCoordinate, array $endCoordinate): void
    {
        $start = new Point($startCoordinate);
        $end = new Point($endCoordinate);
        if ($this->isHorizontalOrVerticalLine($start, $end)) {
            $dots = $this->getPointsBetweenStartAndEnd($start, $end);

            foreach($dots as $dot) {
                if (isset($this->rows[$dot->getY()][$dot->getX()])) {
                    $this->rows[$dot->getY()][$dot->getX()]++;
                    continue;
                }
                if (!isset($this->rows[$dot->getY()])) {
                    $this->rows[$dot->getY()] = [];
                }
                $this->rows[$dot->getY()][$dot->getX()] = 1;
            }
        }
    }

    public function drawAllLines(
        Point $start,
        Point $end
    ): void
    {
        $dots = $this->getPointsBetweenStartAndEndForAllLines($start, $end);

        foreach ($dots as $dot) {
            if (isset($this->rows[$dot->getY()][$dot->getX()])) {
                $this->rows[$dot->getY()][$dot->getX()]++;
                continue;
            }
            if (!isset($this->rows[$dot->getY()])) {
                $this->rows[$dot->getY()] = [];
            }
            $this->rows[$dot->getY()][$dot->getX()] = 1;
        }

    }

    private function isHorizontalOrVerticalLine(Point $start, Point $end): bool
    {
        return $start->getX() === $end->getX() || $start->getY() === $end->getY();
    }

    private function isDiagonal(Point $start, Point $end): bool
    {
        $diffX = abs($start->getX() - $end->getX());
        $diffY = abs($start->getY() - $end->getY());

        return $diffY === $diffX;
    }

    /**
     * 1,1 -> 1,3 covers points 1,1, 1,2, and 1,3.
     * 9,7 -> 7,7 covers points 9,7, 8,7, and 7,7.
     */
    private function getPointsBetweenStartAndEnd(Point $start, Point $end): array
    {
        $dots = [];
        if ($start->getX() === $end->getX()) {
            foreach (range($start->getY(), $end->getY()) as $number) {
                $dots[] = new Point([$start->getX(), $number]);
            }
        }

        if ($start->getY() === $end->getY()) {
            foreach (range($start->getX(), $end->getX()) as $number) {
                $dots[] = new Point([$number, $start->getY()]);
            }
        }

        return $dots;
    }

    private function getPointsBetweenStartAndEndForAllLines(Point $start, Point $end): array
    {
        $dots = [];
        if ($this->isHorizontalOrVerticalLine($start, $end)) {
            if ($start->getX() === $end->getX()) {
                foreach (range($start->getY(), $end->getY()) as $number) {
                    $dots[] = new Point([$start->getX(), $number]);
                }
            }

            if ($start->getY() === $end->getY()) {
                foreach (range($start->getX(), $end->getX()) as $number) {
                    $dots[] = new Point([$number, $start->getY()]);
                }
            }
            return $dots;
        }

        if ($this->isDiagonal($start, $end)) {
            foreach (range($start->getX(), $end->getX()) as $xNumber) {
                $dots[] = new Point([$xNumber, null]);
            }
            foreach (range($start->getY(), $end->getY()) as $yIndex => $yNumber) {
                $dots[$yIndex]->setY($yNumber);
            }
            return $dots;
        }

        return [];
    }

    public function getAmountOfCrossingLines(): int
    {
        $twos = 0;
        foreach ($this->rows as $row) {
            foreach ($row as $point) {
                if ($point >= 2) {
                    $twos++;
                }
            }
        }

        return $twos;
    }
}

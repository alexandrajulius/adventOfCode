<?php

declare(strict_types = 1);

namespace aoc2021\Day13;

final class Point {

    public array $coordinates;

    public function __construct(array $coordinates)
    {
        $this->coordinates = $coordinates;
    }

    public function getY(): int
    {
        return $this->coordinates[0];
    }

    public function getX(): int
    {
        return $this->coordinates[1];
    }
}

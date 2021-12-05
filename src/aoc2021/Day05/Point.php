<?php

declare(strict_types = 1);

namespace aoc2021\Day05;

final class Point
{
    public array $coordinates;

    public function __construct(array $coordinates)
    {
        $this->coordinates = $coordinates;
    }

    public function getX(): int
    {
        return (int)$this->coordinates[0];
    }

    public function getY(): int
    {
        return (int)$this->coordinates[1];
    }

    public function setX(int $value): void
    {
        $this->coordinates[0] = $value;
    }

    public function setY(int $value): void
    {
        $this->coordinates[1] = $value;
    }
}

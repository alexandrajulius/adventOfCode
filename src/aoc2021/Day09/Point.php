<?php

declare(strict_types = 1);

namespace aoc2021\Day09;

final class Point
{
    public array $coordinates;

    public function __construct(array $coordinates)
    {
        $this->coordinates = $coordinates;
    }

    public function getY(): int
    {
        return (int)$this->coordinates[0];
    }

    public function getX(): int
    {
        return (int)$this->coordinates[1];
    }

    public function setY(int $y): void
    {
        $this->coordinates[0] = $y;
    }

    public function setX(int $x): int
    {
        $this->coordinates[1] = $x;
    }

    public function getValue(): int
    {
        return (int)$this->coordinates[2];
    }

    public function hash(): string
    {
        return sprintf("%s,%s", $this->getY(), $this->getX());
    }
}

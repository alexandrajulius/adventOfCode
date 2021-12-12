<?php

declare(strict_types = 1);

namespace aoc2021\Day11;

final class Octopus
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

    public function getValue(): int
    {
        return (int)$this->coordinates[2];
    }

    public function hash(): string
    {
        return sprintf("%s,%s", $this->getY(), $this->getX());
    }

    public function flash(): void
    {
        $this->coordinates[2] = 0;
    }
}

<?php

declare(strict_types = 1);

namespace aoc2021\Day12;

final class Vertex
{
    public string $name;
    public bool $visited;

    public function __construct(
        string $name,
        bool $visited = false
    )
    {
        $this->name = $name;
        $this->visited = $visited;
    }

    public function isSmall(): bool
    {
        return $this->name !== strtoupper($this->name);
    }

    public function isEnd(): bool
    {
        return $this->name === 'end';
    }

    public function getVisited(): bool
    {
        return $this->visited;
    }

    public function setVisited(bool $visited): void
    {
        $this->visited = $visited;
    }
}

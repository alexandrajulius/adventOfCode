<?php

declare(strict_types = 1);

namespace aoc2021\Day12;

final class Edge
{
    public Vertex $start;
    public Vertex $end;
    public bool $visited;

    public function __construct(
        Vertex $start,
        Vertex $end,
        bool $visited = false
    )
    {
        $this->start = $start;
        $this->end = $end;
        $this->visited = $visited;
    }

    public function hash(): string
    {
        return sprintf("%s,%s", $this->start->name, $this->end->name);
    }

    public function isStart(): bool
    {
        return $this->start->name === 'start';
    }

    public function isEnd(): bool
    {
        return $this->start->name === 'end';
    }
}

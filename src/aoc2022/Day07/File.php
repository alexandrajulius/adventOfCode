<?php

declare(strict_types = 1);

namespace aoc2022\Day07;

final class File {

    private string $name;
    private int $size;
    public function __construct(string $name, int $size)
    {
        $this->name = $name;
        $this->size = $size;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function size(): int
    {
        return $this->size;
    }
}

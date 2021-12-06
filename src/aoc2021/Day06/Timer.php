<?php

declare(strict_types = 1);

namespace aoc2021\Day06;

final class Timer
{
    public int $value;
    public bool $current;

    public function __construct(int $value, bool $current)
    {
        $this->value = $value;
        $this->current = $current;
    }

    public function decrease(): void
    {
        $this->value--;
    }

    public function reset(): void
    {
        $this->value = 6;
    }
}

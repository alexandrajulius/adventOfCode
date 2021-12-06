<?php

declare(strict_types = 1);

namespace aoc2021\Day06;

final class Timer
{
    public int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
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

<?php

declare(strict_types = 1);

namespace aoc2021\Day04;

final class Number {

    public string $value;

    public bool $isMarked;

    public function __construct(string $value, bool $isMarked)
    {
        $this->value = $value;
        $this->isMarked = $isMarked;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isMarked(): bool
    {
        return $this->isMarked;
    }

    public function mark(): void
    {
        $this->isMarked = true;
    }
}

<?php

declare(strict_types = 1);

namespace aoc2023\Day01;

final class Word {
    public function __construct(public string $word, public int $position) {}
}
<?php

declare(strict_types = 1);

namespace aoc2023\Day03;

final class Asterisk {
 
    public function __construct(
        public int $index, 
        public int $adjacentPartNumbersCount,
        public array $adjacentPartNumbers,
        ) {}
}
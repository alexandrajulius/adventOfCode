<?php

declare(strict_types = 1);

namespace aoc2023\Day07;

final class Card {

    public int $value = 0;
    private const VALUE_MAP_FIRST_PUZZLE = ['2', '3', '4', '5', '6', '7', '8', '9', 'T', 'J', 'Q', 'K', 'A'];
    private const VALUE_MAP_SECOND_PUZZLE = ['J', '2', '3', '4', '5', '6', '7', '8', '9', 'T', 'Q', 'K', 'A'];

    public function __construct(public string $label) {}

    public function value(int $puzzleCount): int
    {
        return $puzzleCount === 1 ?
            array_search($this->label, self::VALUE_MAP_FIRST_PUZZLE) + 2 :
            array_search($this->label, self::VALUE_MAP_SECOND_PUZZLE) + 1;
    }
}
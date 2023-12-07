<?php

declare(strict_types = 1);

namespace aoc2023\Day07;

final class Card implements CardInterface {

    private const VALUE_MAP = ['2', '3', '4', '5', '6', '7', '8', '9', 'T', 'J', 'Q', 'K', 'A'];

    public function __construct(public string $label) {}

    public function value(): int
    {
        return array_search($this->label, self::VALUE_MAP) + 2;
    }
}
<?php

declare(strict_types = 1);

namespace aoc2023\Day07;

interface HandInterface {

    /**
     * @param string[]
     */
    public static function from(array $rawCardsAndBids): self;

    public static function determineType(Hand $hand): void;
}
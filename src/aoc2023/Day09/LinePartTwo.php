<?php

declare(strict_types = 1);

namespace aoc2023\Day09;

final class LinePartTwo extends Line {

    public function __construct(public array $values) {}

    public function getNextValue(): int
    {
        $sequences = $this->buildSequences();
        $nextValue = 0;
        foreach ($sequences as $i => $sequence) {
            $nextValue = $sequences[$i][0] - $nextValue;
        }
    
        return $nextValue;
    }
}
<?php

declare(strict_types=1);

namespace aoc2020\Day10;

final class Day10
{
    // Adapter Array
    public function findContiguousSetOfInvalidNumbers(string $rawInput): int
    {
        $numbers = $this->convertInput($rawInput);

        return 1;
    }

    private function convertInput(string $rawInput): array
    {
        return array_map('intval', explode("\n", $rawInput));
    }
}

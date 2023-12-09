<?php

declare(strict_types = 1);

namespace aoc2023\Day08;

final class Day08
{
    public function partOne(string $input): int
    {
        return (Map::from($input))->stepsPartOne();
    }

    public function partTwo(string $input): int
    {
        return (Map::from($input))->stepsPartTwo();
    }
}
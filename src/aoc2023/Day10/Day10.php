<?php

declare(strict_types = 1);

namespace aoc2023\Day10;

final class Day10
{
    public function partOne(string $input): int
    {        
        $paths = (Maze::from($this->getRaw($input)))->traverse();

        return (count($paths) - 1) / 2;
    }

    private function getRaw(string $input): array
    {
        return array_map('trim', explode(PHP_EOL, $input));
    }
}
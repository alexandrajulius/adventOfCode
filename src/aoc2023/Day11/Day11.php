<?php

declare(strict_types = 1);

namespace aoc2023\Day11;

final class Day11
{
    public function partOne(string $input): int
    {       
        $universe = new Universe($this->getRaw($input), 1); 

        return $universe->findShortestDistancesSum();
    }

    public function partTwo(string $input): int
    {       
        $universe = new Universe($this->getRaw($input), 1000000 - 1); 

        return $universe->findShortestDistancesSum();
    }

    private function getRaw(string $input): array
    {
        $raw = array_map('trim', explode(PHP_EOL, $input));
    
        return $this->countedGalaxies($raw);
    }

    private function countedGalaxies(array $rawUniverse): array
    {
        $count = 1;
        return array_map(function ($line) use (&$count) {
            return array_map(function ($item) use (&$count) {
                return $item === '#' ? $count++ : '.';
            }, str_split($line));
        }, $rawUniverse);
    }
}
<?php

declare(strict_types = 1);

namespace aoc2021\Day12;

final class Day12
{
    public function firstTask(string $input): int
    {
        $caveMap = Graph::create($input, 'firstTask');
        $allPaths = $caveMap->getAllPaths();

        return count($allPaths);
    }

    public function secondTask(string $input): int
    {
        $caveMap = Graph::create($input, 'secondTask');
        $allPaths = $caveMap->getAllPaths();

        return count($allPaths);
    }
}

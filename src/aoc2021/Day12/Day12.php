<?php

declare(strict_types = 1);

namespace aoc2021\Day12;

final class Day12
{
    public function task(string $input, string $flag): int
    {
        $caveMap = Graph::create($input, $flag);
        $allPaths = $caveMap->getAllPaths();

        return count($allPaths);
    }
}

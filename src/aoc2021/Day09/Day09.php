<?php

declare(strict_types = 1);

namespace aoc2021\Day09;

final class Day09
{
    public function firstTask(string $input): int
    {
        $heightmap = $this->getHeightMap($input);
        $lowestPoints = $heightmap->getLowestPoints();
        $lowestPointValues = [];
        foreach ($lowestPoints as $point) {
            $lowestPointValues[] = $point->getValue() + 1;
        }

        return array_sum($lowestPointValues);
    }

    private function getHeightMap(string $input): HeightMap
    {
        $lanes = explode("\n", $input);

        return HeightMap::create($lanes);
    }

    public function secondTask(string $input): int
    {
        $heightmap = $this->getHeightMap($input);
        $lowestPoints = $heightmap->getLowestPoints();

        $basinSizes = [];
        foreach ($lowestPoints as $point) {
            $basinSizes[] = $heightmap->getBasinSize($point);
        }

        asort($basinSizes);

        return array_product(array_slice($basinSizes, -3, 3, true));
    }
}

<?php

declare(strict_types = 1);

namespace aoc2021\Day06;

final class Day06
{
    public function firstTask(string $input, int $days): int
    {
        $fishMap = $this->getFishMap($input);
        while ($days >= 1) {

            $nextFishMap = $this->getEmptyFishMap();
            $newBorn = $fishMap[0];
            foreach ($fishMap as $timer => $amountOfFish) {
                    $nextFishMap[$timer - 1] = $fishMap[$timer];
                    $nextFishMap[$timer] = $fishMap[$timer] - $amountOfFish;
            }
            $fishMap = $nextFishMap;

            $fishMap[6] = $nextFishMap[6] + $newBorn;
            $fishMap[8] = $nextFishMap[8] + $newBorn;
            $days--;
        }

        return array_sum(array_values($fishMap));
    }

    private function getFishMap(string $input): array
    {
        $stringList = explode(',', $input);
        $fishMap = $this->getEmptyFishMap();

        foreach ($stringList as $timer) {
            ++$fishMap[(int)$timer];
        }

        return $fishMap;
    }

    private function getEmptyFishMap(): array
    {
        $fishMap = [];
        foreach (range(0, 8) as $index) {
            $fishMap[$index] = 0;
        }

        return $fishMap;
    }

}

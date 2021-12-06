<?php

declare(strict_types = 1);

namespace aoc2021\Day06;

final class Day06
{
    /**
     * $fishMap init for [3,4,3,1,2]
     * [
     *      0 => 0
     *      1 => 1
     *      2 => 1
     *      3 => 2
     *      4 => 1
     *      5 => 0
     *      6 => 0
     *      7 => 0
     *      8 => 0
     * ]
     */
    public function firstAndSecondTask(string $input, int $days): int
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
        return array_map(function(int $index): int {
            return 0;
        }, range(0,8));
    }
}

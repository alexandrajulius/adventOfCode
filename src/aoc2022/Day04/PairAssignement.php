<?php

declare(strict_types = 1);

namespace aoc2022\Day04;

final class PairAssignement {

    private string $first;
    private string $second;


    public function __construct(string $first, string $second)
    {
        $this->first = $first;
        $this->second = $second;
    }

    public function fullyOverlaps(): bool
    {
        $first = $this->getMinMax($this->first);
        $second = $this->getMinMax($this->second);
    
        return ($first[0] <= $second[0] && $first[1] >= $second[1]) || ($first[0] >= $second[0] && $first[1] <= $second[1]);
    }

    public function partlyOverlaps(): bool
    {
        $firstRange = $this->getRange($this->first);
        $secondRange = $this->getRange($this->second);

        foreach ($firstRange as $first) {
            if (in_array($first, $secondRange)) {
                return true;
            }
        }

        foreach ($secondRange as $first) {
            if (in_array($first, $firstRange)) {
                return true;
            }
        }

        return false;
    }

    private function getMinMax(string $assignement): array
    {
        $arr = explode('-', $assignement);

        return [$arr[0], $arr[1]];
    }

    private function getRange(string $assignement): array
    {
        $arr = explode('-', $assignement);

        return range($arr[0], $arr[1]);
    }
}

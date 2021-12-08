<?php

declare(strict_types = 1);

namespace aoc2021\Day08;

final class Decoder 
{
    public array $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function getAssignments(): array
    {
        $map = [];
        foreach ($this->input as $input) {
            if (strlen($input) === 2) {
                $map[1] = str_split($input, 1);
            }
            if (strlen($input) === 4) {
                $map[4] = str_split($input, 1);
            }
            if (strlen($input) === 3) {
                $map[7] = str_split($input, 1);
            }
            if (strlen($input) === 7) {
                $map[8] = str_split($input, 1);
            }
        }

        foreach ($this->input as $input) {
            if (strlen($input) === 5) {
                $temp = str_split($input, 1);
                if ($this->isSubset($temp, $map[1])) {
                    $map[3] = $temp;
                }

            }
        }

        foreach ($this->input as $input) {
            if (strlen($input) === 5) {
                $temp = str_split($input, 1);
                if (!$this->isSubset($temp, $map[1])) {
                    if ($this->matchesSegments(3, $temp, $map[4])) {
                        $map[5] = $temp;
                    }
                }
            }
        }

        foreach ($this->input as $input) {
            if (strlen($input) === 5) {
                $temp = str_split($input, 1);
                if (!$this->isSubset($temp, $map[1])) {
                    if (!$this->isSubset($temp, $map[5])) {
                        $map[2] = $temp;
                    }
                }
            }
        }

        foreach ($this->input as $input) {
            if (strlen($input) === 6) {
                $temp = str_split($input, 1);
                if ($this->isSubset($temp, $map[5]) && !$this->isSubset($temp, $map[1])) {
                    $map[6] = $temp;
                }
            }
        }

        foreach ($this->input as $input) {
            if (strlen($input) === 6) {
                $temp = str_split($input, 1);
                if ($this->isSubset($temp, $map[4])) {
                    $map[9] = $temp;
                }
            }
        }

        foreach ($this->input as $input) {
            if (strlen($input) === 6) {
                $temp = str_split($input, 1);
                if (!$this->isSubset($temp, $map[6]) && !$this->isSubset($temp, $map[9])) {
                    $map[0] = $temp;
                }
            }
        }

        return $map;
    }

    /**
    if (count($one) === count(array_intersect($tempThree, $one))) {
         $three = $tempThree;
    }
     */
    private function isSubset(array $seedArray, array $sourceArray): bool
    {
        return count($sourceArray) === count(array_intersect($seedArray, $sourceArray));
    }

    private function matchesSegments(int $count, array $seedArray, array $sourceArray): bool
    {
        $counter = 0;
        foreach ($sourceArray as $source) {
            if (in_array($source, $seedArray, true)) {
                $counter++;
            }
        }

        return $count === $counter;
    }
}

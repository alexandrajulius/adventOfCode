<?php

declare(strict_types = 1);

namespace aoc2022\Day04;

final class Day04
{
    private array $assignments;

    public function __construct(string $input)
    {
        $this->assignments = $this->getElveAssignments($input);
    }
    
    public function firstTask(): int
    {   
        $count = 0;
        foreach ($this->assignments as $assignement) {
            if ($assignement->fullyOverlaps()) {
                $count++;
            }
        }

        return $count;
    }

    public function secondTask(): int
    {   
        $count = 0;
        foreach ($this->assignments as $assignement) {
            if ($assignement->partlyOverlaps()) {
                $count++;
            }
        }

        return $count;
    }

    private function getElveAssignments(string $input): array
    {
        $trimmed = preg_replace('/[ ]{2,}|[\t]/', '', trim($input));
        $rawAssignements = explode("\n", $trimmed);

        $assignements = [];
        foreach ($rawAssignements as $rawAssignement) {
            $pair = explode(',', $rawAssignement);
            $assignements[] = new PairAssignement($pair[0], $pair[1]);
        }
        
        return $assignements;
    }
}

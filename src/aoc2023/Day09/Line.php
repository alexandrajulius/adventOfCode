<?php

declare(strict_types = 1);

namespace aoc2023\Day09;

class Line {

    public function __construct(public array $values) {}

    public function getNextValue(): int
    {
        $sequences = $this->buildSequences();
        $result = 0;
        foreach ($sequences as $i => $sequence) {
            $result += $sequences[$i][count($sequence) - 1];
        }
       
        return $result;
    }

    protected function buildSequences(): array
    {
        $sequences[0] = $this->values;  
        $currentSequence = $this->values;
        while (!$this->containsOnlyZeros($currentSequence)) {
            $nextSequence = $this->getDiffs($currentSequence);
            $sequences[] = $nextSequence;
            $currentSequence = $nextSequence;
        }
        array_pop($sequences);

        return array_reverse($sequences);
    }

    protected function getDiffs(array $line): array
    {
        $diffs = [];
        for ($i = 0; $i < count($line) - 1; $i++) {
            $diffs[] = $line[$i + 1] - $line[$i];
        }

        return $diffs;
    } 

    protected function containsOnlyZeros(array $sequence): bool
    {
        return $sequence[0] === 0 && count(array_count_values($sequence)) === 1;
    }
}
<?php

declare(strict_types = 1);

namespace aoc2023\Day11;

class Universe {

    public function __construct(
        public array $universe,
        public int $multiplier
        ) {}

    public function findShortestDistancesSum(): int
    {
        $pairs = $this->findGalaxyPairs();
        $paths = [];
        foreach ($pairs as $pair) {
            $paths[] = $this->findShortestDistance($pair);
        }

        return array_sum($paths);
    } 

    private function findShortestDistance(array $galaxyPair): int
    {
        $firstGalaxyPos = $this->getPositionInUniverse($galaxyPair[0]);
        $secondGalaxyPos = $this->getPositionInUniverse($galaxyPair[1]);
        $verticalRange = [$firstGalaxyPos[0], $secondGalaxyPos[0]];
        $horizontalRange = [$firstGalaxyPos[1], $secondGalaxyPos[1]];
        sort($verticalRange);
        sort($horizontalRange);

        $verticalDiff = abs($verticalRange[1] - $verticalRange[0]);
        $horizontalDiff = abs($horizontalRange[1] - $horizontalRange[0]);

        $verticalExpansion = $this->expandGalaxyVertically($verticalRange[0], $verticalRange[1]);
        $horizontalExpansion = $this->expandGalaxyHorizontally($horizontalRange[0], $horizontalRange[1]);
    
        return $verticalDiff + ($verticalExpansion * $this->multiplier) + $horizontalDiff + ($horizontalExpansion * $this->multiplier);
    }

    private function expandGalaxyVertically(int $start, int $end): int
    {
        $count = 0;
        for ($i = $start; $i <= $end; $i++) {
            if (!$this->hasGalaxy($this->universe[$i])) {
                $count++;
            }
        }
        return $count;
    }

    private function expandGalaxyHorizontally(int $start, int $end): int
    {
        $count = 0;
        for ($i = $start; $i <= $end; $i++) {
            if (!$this->hasGalaxy(array_column($this->universe, $i))) {
                $count++;
            }
        }
        return $count;
    }

    private function getPositionInUniverse(int $galaxy): ?array
    {
        foreach ($this->universe as $i => $line) {
            foreach ($line as $j => $item) {
                if ($item === $galaxy) {
                    return [$i, $j];
                }
            }
        }
        return null;
    }

    private function findGalaxyPairs(): array
    {
        $lastGalaxy = $this->getLastGalaxy();
        $pairs = [];
        for ($i = 1; $i < $lastGalaxy; $i++) {
            for ($galaxy = $i + 1; $galaxy <= $lastGalaxy; $galaxy++) {
                $pairs[] = [$i, $galaxy];
            }
        }
        return $pairs;
    }

    private function getLastGalaxy(): int
    {
        $lastLine = $this->universe[count($this->universe) - 1];

        return array_key_last(array_count_values($lastLine));
    }

    private function hasGalaxy(array $universePart): bool
    {
        return count(array_count_values($universePart)) > 1;
    }
}
<?php

declare(strict_types = 1);

namespace aoc2024\Day01;

final class Day01
{
    protected array $rawList = [];
    protected array $locationIdsList_1 = [];
    protected array $locationIdsList_2 = [];

    public function __construct(protected string $input)
    {
        $this->rawList = $this->toArray($input);
    }

    public function partOne(): int
    {
        $this->createLocationIdsLists();

        sort($this->locationIdsList_1);
        sort($this->locationIdsList_2);

        return $this->getTotalDistance();
    }

    public function partTwo(): int
    {
        $this->createLocationIdsLists();

        return $this->getSimilarityScore();
    }

    /**
     * @return string[]|bool
     */
    private function toArray(string $input): array
    {
        return explode(PHP_EOL, $input);
    }

    private function createLocationIdsLists(): void
    {
        foreach ($this->rawList as $elem) {
            if ($elem !== '') {
                $locationIds = explode('   ', $elem);
                $this->locationIdsList_1[] = (int)$locationIds[0];
                $this->locationIdsList_2[] = (int)$locationIds[1];
            }
        }
    }

    private function getTotalDistance(): int
    {
        $totalDistance = 0;
        foreach ($this->locationIdsList_2 as $key => $locationId_2) {
            $totalDistance += abs($locationId_2 - $this->locationIdsList_1[$key]);
        }

        return $totalDistance;
    }

    private function getSimilarityScore(): int
    {
        $similarityScore = 0;
        foreach ($this->locationIdsList_1 as $locationId) {
            $indexes = array_keys($this->locationIdsList_2, $locationId);
            $similarityScore += count($indexes) * $locationId;
        }

        return $similarityScore;
    }
}

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
        foreach ($this->rawList as $elem) {
            if ($elem !== '') {
                $locationIds = explode('   ', $elem);
                $this->locationIdsList_1[] = (int)$locationIds[0];
                $this->locationIdsList_2[] = (int)$locationIds[1];
            }
        }
        sort($this->locationIdsList_1);
        sort($this->locationIdsList_2);

        return $this->getTotalDistance();
    }

    /**
     * @return string[]|bool
     */
    private function toArray(string $input): array
    {
        return explode(PHP_EOL, $input);
    }

    public function getTotalDistance(): int
    {
        $totalDistance = 0;
        foreach ($this->locationIdsList_2 as $key => $locationId_2) {
            $totalDistance += abs($locationId_2 - $this->locationIdsList_1[$key]);
        }
        
        return $totalDistance;
    }
}

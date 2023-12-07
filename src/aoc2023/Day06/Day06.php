<?php

declare(strict_types = 1);

namespace aoc2023\Day06;

final class Day06
{
    public array $seeds = [];
    public array $maps = [];

    public function partOne(string $input): int
    {
        $raw = $this->getFirstTaskInput($input);
        $racesWinCount = [];
        foreach ($raw as $item) {
            $racesWinCount[] = (Race::from($item))->getWinCount();
        }

        return array_product($racesWinCount);
    }

    public function partTwo(string $input): int
    {
        $raw = $this->getRaw($input);
        $time = $this->getSecondTaskInput($raw[0]);
        $distance = $this->getSecondTaskInput($raw[1]);;
       
        return (Race::from([$time, $distance]))->getWinCount();
    }

    private function getFirstTaskInput(string $input): array
    {        
        $raw = $this->getRaw($input);
        $times = $this->getDigits($raw[0]);
        $distances = $this->getDigits($raw[1]);

        $combined = array_map(
            function ($time, $distance) {
                return [$time, $distance];
            },
            $times,
            $distances
        );
        
        return $combined;
    }

    private function getSecondTaskInput(string $raw): int
    {
        return intval(str_replace(' ', '', $this->removeTitle($raw)));;
    }

    private function getRaw(string $input): array
    {
        return array_map('trim', explode(PHP_EOL, $input));
    }

    private function removeTitle(string $raw): string
    {
        return trim(substr($raw, strpos($raw, ':') + 2));
    }

    private function getDigits(string $raw): array 
    {
        $removedTitle = $this->removeTitle($raw);
        $toArray = array_map(function($item) {
            return intval(trim($item));
        }, explode(' ', $removedTitle));     
        
        return array_values(array_filter($toArray));
    }
}
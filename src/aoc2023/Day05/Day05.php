<?php

declare(strict_types = 1);

namespace aoc2023\Day05;
//ini_set('memory_limit', '-1');

/**
 * Since PHP doesn't support data type bigint, this task can only be solved for the sample input,
 * not for the actual input since the indexes are too big.
 * 
 * If I was able to store the given input with PHP, I could apply lazy evaluation with Iterators or Generators 
 * and potentially solve the first and second task.
 */
final class Day05
{
    public array $seeds = [];
    public array $maps = [];

    public function firstTask(string $input): float
    {
        $raw = $this->toArray($input);
        $this->seeds = $this->getSeeds($raw[0]);
        unset($raw[0]);
        $this->maps = $this->getMaps($raw);

        return $this->lowestLocation();
    }

    private function lowestLocation(): float
    {
        $locations = [];
        foreach ($this->seeds as $seed) {
            foreach ($this->maps as $map) {
                if ($map->name === 'seed-to-soil') {
                    $soil = $this->getMapValue($seed, $map);
                }
                if ($map->name === 'soil-to-fertilizer') {
                    $fertilizer = $this->getMapValue($soil, $map);
                }
                if ($map->name === 'fertilizer-to-water') {
                    $water = $this->getMapValue($fertilizer, $map);
                }
                if ($map->name === 'water-to-light') {
                    $light = $this->getMapValue($water, $map);
                }
                if ($map->name === 'light-to-temperature') {
                    $temperature = $this->getMapValue($light, $map);
                }
                if ($map->name === 'temperature-to-humidity') {
                    $humidity = $this->getMapValue($temperature, $map);
                }
                if ($map->name === 'humidity-to-location') {
                    $location = $this->getMapValue($humidity, $map);
                }
            }
            $locations[] = $location;
        }

        return min($locations);
    }

    private function getMapValue(float $index, Map $map): float
    {
        return isset($map->lookup[$index]) ? $map->lookup[$index] : $index;
    }

    private function getSeeds(string $raw): array
    {
        return array_map('intval', explode(' ', substr($raw, strpos($raw, ':') + 2)));
    }

    private function getMaps(array $raw): array
    {
        return array_map(fn($item) => Map::from($item), $raw);
    }

    private function toArray(string $input): array
    {
        return array_map('trim', preg_split("#\n\s*\n#Uis", $input));
    }
}
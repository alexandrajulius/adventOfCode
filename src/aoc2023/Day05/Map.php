<?php

declare(strict_types = 1);

namespace aoc2023\Day05;
//ini_set('memory_limit', '-1');

final class Map {

    public string $name = '';
    public array $lookup = [];
 
    public static function from(string $raw): self
    {
        $map = new self();

        $rawArray = array_map('trim', explode(PHP_EOL, $raw));
        $map->name = self::getMapName($rawArray);
        $sourceRange = [];
        $destinationRange = [];
        unset($rawArray[0]);
        foreach ($rawArray as $item) {
            $arr = explode(' ', $item);       
            $sourceRange = array_merge($sourceRange, self::getRange((float) $arr[1], (float) $arr[2]));
            $destinationRange = array_merge($destinationRange, self::getRange((float) $arr[0], (float) $arr[2])); 
        }
      
        $map->lookup = array_combine($sourceRange, $destinationRange);
        asort($map->lookup);
    
        return $map;
    }

    private static function getMapName(array $raw): string
    {
        return str_replace(' map:', '', $raw[0]);
    }

    private static function getRange(float $start, float $length): array
    {   
        return range($start, $start + $length - 1);
    }
}
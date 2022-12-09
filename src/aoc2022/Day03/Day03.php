<?php

declare(strict_types = 1);

namespace aoc2022\Day03;

final class Day03
{
    private array $priorities;

    public function __construct()
    {
        $this->priorities = $this->createPriorities();
    }

    public function firstTask(string $input): int
    {   
        $sum = 0;
        $rucksacks = $this->getRucksackContentPerElve($input);
        foreach ($rucksacks as $rucksack) {
            $sum += array_search(
                $rucksack->commonElement(), 
                $this->priorities
            );
        }

        return $sum;
    }

    public function secondTask(string $input): int
    {   
        $sum = 0;
        $rucksackGroups = $this->getRucksackContentGroups($input);
        foreach ($rucksackGroups as $group) {
            $sum += array_search(
                $this->getCommonElement($group), 
                $this->priorities
            );
        }

        return $sum;
    }

    private function getRucksackContentPerElve(string $input): array
    {
        $trimmed = preg_replace('/[ ]{2,}|[\t]/', '', trim($input));
        $rawRucksacks = explode("\n", $trimmed);
        
        return array_map(function(string $content): Rucksack {
            return new Rucksack($content);
        }, $rawRucksacks);
    }

    private function getRucksackContentGroups(string $input): array
    {
        $trimmed = preg_replace('/[ ]{2,}|[\t]/', '', trim($input));
        $rawRucksacks = explode("\n", $trimmed);

        return array_chunk($rawRucksacks, 3);
    }

    private function getCommonElement(array $group): string
    {
        $groupNewFormat = array_map(function(string $rawRucksack): array {
            return str_split($rawRucksack);
        }, $group);
        $commonElement = array_intersect($groupNewFormat[0], $groupNewFormat[1], $groupNewFormat[2]);

        return array_values(array_unique($commonElement))[0];
    }

    private function createPriorities(): array
    {
        $lower = range('a', 'z');
        $upper = range('A', 'Z');
        $letters = array_merge($lower, $upper);   

        return $this->reindex($letters, 1);
    }

    private function reindex (array $arr, int $startIndex): array
    {
      return array_combine(range($startIndex, count($arr) + ($startIndex - 1)), array_values($arr)); 
    }
}

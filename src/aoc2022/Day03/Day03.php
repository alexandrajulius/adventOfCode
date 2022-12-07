<?php

declare(strict_types = 1);

namespace aoc2022\Day03;

final class Day03
{
    public function firstTask(string $input): int
    {   
        $sum = 0;
        $rucksacks = $this->getRucksackContentPerElve($input);
        foreach ($rucksacks as $rucksack) {
            $item = $rucksack->commonElement();
            $sum += $this->getPriority($item);
        }

        return $sum;
    }

    public function secondTask(string $input): int
    {   
        $sum = 0;
        $rucksackGroups = $this->getRucksackContentGroups($input);
        foreach ($rucksackGroups as $group) {
            $item = $this->getCommonElement($group);
            $sum += $this->getPriority($item);
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
        $groupNewFormat = [];
        foreach ($group as $rawRucksack) {
            $groupNewFormat[] = str_split($rawRucksack);
        }
        $commonElement = array_intersect($groupNewFormat[0], $groupNewFormat[1], $groupNewFormat[2]);

        return array_values(array_unique($commonElement))[0];
    }

    private function getPriority(string $item): int
    {
        $lower = range('a', 'z');
        $upper = range('A', 'Z');
        $letters = array_merge($lower, $upper);      
        $priorities = $this->reindex($letters, 1);

        return array_search($item, $priorities);;
    }

    private function reindex ($arr, $start_index): array
    {
      return array_combine(range($start_index,  count($arr) + ($start_index - 1)), array_values($arr)); 
    }
}

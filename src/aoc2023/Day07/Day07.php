<?php

declare(strict_types = 1);

namespace aoc2023\Day07;

final class Day07
{
    public array $seeds = [];
    public array $maps = [];

    public function firstTask(string $input): int
    {
        $raw = $this->getRaw($input);
        $hands = array_map(fn($item) => Hand::from($item), $raw);
        $ranked = (new Game($hands))->rank();

        $totalWinnings = [];
        foreach ($ranked as $key => $hand) {
            $totalWinnings[] = $hand->bid * ($key + 1);
        }
   
        return array_sum($totalWinnings);
    }

    public function secondTask(string $input): int
    {
        $raw = $this->getRaw($input);
        $hands = array_map(fn($item) => HandPartTwo::from($item), $raw);
        $ranked = (new Game($hands))->rank();

        $totalWinnings = [];
        foreach ($ranked as $key => $hand) {
            $totalWinnings[] = $hand->bid * ($key + 1);
        }
   
        return array_sum($totalWinnings);
    }
   
    private function getRaw(string $input): array
    {
        $raw = array_map('trim', explode(PHP_EOL, $input));
        $rawCardsAndBids = [];
        foreach ($raw as $line) {
            $item = explode(' ', $line);
            $rawCardsAndBids[] = [$item[0], $item[1]];
        }

        return $rawCardsAndBids;
    } 
}
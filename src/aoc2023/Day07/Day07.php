<?php

declare(strict_types = 1);

namespace aoc2023\Day07;

final class Day07
{
    public function partOne(string $input): int
    {
        $raw = $this->getRaw($input);
        $hands = array_map(fn($item) => Hand::from($item), $raw);

        return array_sum($this->getTotalWinnings((new Game($hands))->rank()));
    }

    public function partTwo(string $input): int
    {
        $raw = $this->getRaw($input);
        $hands = array_map(fn($item) => HandPartTwo::from($item), $raw);
   
        return array_sum($this->getTotalWinnings((new Game($hands))->rank()));
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

    private function getTotalWinnings(array $ranked): array
    {
        $totalWinnings = [];
        foreach ($ranked as $key => $hand) {
            $totalWinnings[] = $hand->bid * ($key + 1);
        }

        return $totalWinnings;
    }
}
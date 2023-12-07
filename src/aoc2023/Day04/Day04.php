<?php

declare(strict_types = 1);

namespace aoc2023\Day04;

final class Day04
{
    public array $originalCards = [];
    public array $cardDeck = [];

    public function firstTask(string $input): int
    {
        $scores = [];
        foreach ($this->toArray($input) as $line) {
            $card = Scratchcard::from($line);
            $scores[] = $this->getScore($card->getWinningGameNumbersCount());
        }

        return array_sum($scores);
    }

    public function secondTask(string $input): int
    {
        foreach ($this->toArray($input) as $key => $line) {
            $card = Scratchcard::from($line);
            $this->originalCards[$key + 1] = $card;
        }

        for ($i = 1; $i <= count($this->originalCards); $i++) {
            // put yourself into the deck or increase your count
            $this->updateCardDeck($i, 1);
           
            $winningGameNumbersCount = $this->originalCards[$i]->getWinningGameNumbersCount();
            if ($winningGameNumbersCount === 0) {
                continue;
            }
    
            // put all copies from your winningNumbers into the deck or increase their count     
            $range = range($i + 1, $i + $winningGameNumbersCount);   
            foreach ($range as $index) {
                $this->updateCardDeck($index, $this->cardDeck[$i]->countInDeck);
            }
        }

        return $this->cardCountsSum();
    }

    /**
     * @return string[]|bool
     */
    private function toArray(string $input): array
    {
        return array_map(
            fn($item) => substr($item, strpos($item, ':') + 2),
            explode(PHP_EOL, $input)
        );
    }

    private function getScore(int $winningGameNumbersCount): int
    {
        if ($winningGameNumbersCount === 0 || $winningGameNumbersCount === 1) {
            return $winningGameNumbersCount;
        }

        return pow(2, $winningGameNumbersCount - 1);
    }

    private function updateCardDeck(int $i, int $count): void
    {
        if (!isset($this->cardDeck[$i])) {
            $this->cardDeck[$i] = clone $this->originalCards[$i];
            $this->cardDeck[$i]->countInDeck = 1;
        } else {
            $this->cardDeck[$i]->countInDeck += $count;
        }    
    }

    private function cardCountsSum(): int
    {
        return array_reduce(
            $this->cardDeck,
            fn($sum, $card) => $sum + $card->countInDeck,
            0
        );
    }
}
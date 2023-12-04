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
        $toArr = explode(PHP_EOL, $input);
        $raw = [];
        foreach ($toArr as $item) {
            $raw[] = substr($item, strpos($item, ':') + 2);
        }
  
        return $raw;
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
            $copy = Scratchcard::from($this->originalCards[$i]->original);
            $copy->countInDeck = 1;
            $this->cardDeck[$i] = $copy;  
        } else {
            $this->increaseCardCount($i, $count);
        }    
    }

    private function increaseCardCount(int $i, int $count): void
    {
        $this->cardDeck[$i]->countInDeck += $count;
    }

    private function cardCountsSum(): int
    {
        $cardcounts = 0;
        foreach ($this->cardDeck as $card) {
            $cardcounts += $card->countInDeck;
        }

        return $cardcounts;
    }
}
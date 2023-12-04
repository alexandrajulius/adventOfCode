<?php

declare(strict_types = 1);

namespace aoc2023\Day04;

final class Scratchcard {

    public string $original = '';
    public array $winningNumbers = [];
    public array $gameNumbers = [];
    public int $countInDeck = 0;
    
    public static function from(string $input): self
    {
        $card = new self();
        $card->original = $input;
        $split = explode('|', $input);
        
        $card->winningNumbers = array_filter(explode(' ', $split[0]));
        $card->gameNumbers = array_filter(explode(' ', $split[1]));
        
        return $card;
    }

    public function getWinningGameNumbersCount(): int
    {
        $winningGameNumbersCount = 0;
        foreach ($this->gameNumbers as $gameNumber) {
            if (in_array($gameNumber, $this->winningNumbers)) {
                $winningGameNumbersCount += 1;
            }
        }
      
        return $winningGameNumbersCount;
    }
}
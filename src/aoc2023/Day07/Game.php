<?php

declare(strict_types = 1);

namespace aoc2023\Day07;

final class Game {

    public function __construct(
        /** @var Hand[] */
        public array $hands
        ) {}

    public function rank(): array
    {
        usort($this->hands, function($first, $second) {
            if ($first->strength === $second->strength) {         
                return $this->firstHandRanksHigher($first, $second);
            } else {
                return $first->strength > $second->strength;
            }
        });
       
        return $this->hands;
    }

    private function firstHandRanksHigher(Hand $first, Hand $second): bool
    {
        foreach ($first->cardValues as $key => $value) {
            if ($value === $second->cardValues[$key]) {
                continue;
            }
            if ($value > $second->cardValues[$key]) {
                return true;
            }
            if ($value < $second->cardValues[$key]) {
                return false;
            }
        }

        return false;
    }
}
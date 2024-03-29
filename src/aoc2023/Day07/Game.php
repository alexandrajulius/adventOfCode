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
        usort($this->hands, function ($first, $second) {
            if ($first->strength === $second->strength) {
                return $this->compareHands($first, $second);
            } else {
                return $first->strength - $second->strength;
            }
        });
    
        return $this->hands;
    }
    
    private function compareHands(Hand $first, Hand $second): int
    {
        foreach ($first->cardValues as $key => $value) {
            if ($value === $second->cardValues[$key]) {
                continue;
            }
    
            return $value - $second->cardValues[$key];
        }
    
        return 0;
    }
}
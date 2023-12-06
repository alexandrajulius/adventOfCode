<?php

declare(strict_types = 1);

namespace aoc2023\Day06;

final class Race {

    public int $time = 0;
    public int $recordDistance = 0;

    public static function from(array $raw): self
    {
        $race = new self();
        $race->time = $raw[0];
        $race->recordDistance = $raw[1];

        return $race;
    }

    public function getWinCount(): int
    {
        $win = 0;
        for ($i = 1; $i < $this->time; $i++) {
            $distance = $i * ($this->time - $i);
            if ($distance > $this->recordDistance) {
                $win++;
            }
        }
        return $win;
    }
  
}
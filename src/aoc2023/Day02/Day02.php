<?php

declare(strict_types = 1);

namespace aoc2023\Day02;

final class Day02
{
    public function firstTask(string $input): int
    {
        $formatedInput = $this->toArray($input);
        $score = 0;
        foreach ($formatedInput as $key => $line) {
            $game = Game::from($line);
            $game->id = $key + 1;
            if ($game->isPossible()) {
                $score += $game->id;
            }
        }
       
        return $score;
    }

    public function secondTask(string $input): int
    {
        $formatedInput = $this->toArray($input);
        $setPowers = [];
        foreach ($formatedInput as $key => $line) {
            $game = Game::from($line);
            $setPowers[] = max($game->setsMaxBlue) * max($game->setsMaxRed) * max($game->setsMaxGreen);
        }
       
        return array_sum($setPowers);
    }

    /**
     * @return string[]|bool
     */
    private function toArray(string $input): array
    {
        return explode(PHP_EOL, preg_replace('/[ ]{2,}|[\t]/', '', trim($input)));
    }
}
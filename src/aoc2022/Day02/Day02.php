<?php

declare(strict_types = 1);

namespace aoc2022\Day02;

final class Day02
{
    public array $playerOneMap = [
        'A' => 'Rock',
        'B' => 'Paper',
        'C' => 'Scissors'
    ];
    public array $playerTwoMap = [
        'X' => 'Rock',
        'Y' => 'Paper',
        'Z' => 'Scissors'
    ];

    public array $moves;

    public function __construct(string $input)
    {
        $this->moves = $this->getMoves($input);
    }
    
    public function firstTask(): int
    {
        $sum = 0;
        foreach ($this->moves as $move) {
            $players = explode(' ', $move);
            $game = new Game(
                $this->playerOneMap[$players[0]],
                $this->playerTwoMap[$players[1]]
            );
            $sum += $game->resultFirstTask();
        }
        return $sum;
    }

    public function secondTask(): int
    {
        $sum = 0;
        foreach ($this->moves as $move) {
            $players = explode(' ', $move);
            $game = new Game(
                $this->playerOneMap[$players[0]],
                $players[1]
            );
            $sum += $game->resultSecondTask();
        }
        return $sum;
    }

    private function getMoves(string $input): array
    {
        $trimmed = preg_replace('/[ ]{2,}|[\t]/', '', trim($input));

        return explode("\n", $trimmed);
    }
  }

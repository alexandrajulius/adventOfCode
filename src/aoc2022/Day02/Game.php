<?php

declare(strict_types = 1);

namespace aoc2022\Day02;

final class Game {

    private string $playerOne;

    private string $playerTwo;

    private array $decisionMap = [
        'Rock Scissors' => 0,
        'Scissors Rock' => 6,
        'Scissors Paper' => 0,
        'Paper Scissors' => 6,
        'Paper Rock' => 0,
        'Rock Paper' => 6
    ];

    private array $winMatches = [
        'Rock' => 'Paper',
        'Paper' => 'Scissors',
        'Scissors' => 'Rock'
    ];

    public array $shapeScoreMap = [
        'A' => 1,
        'B' => 2,
        'C' => 3
    ];

    public array $humanReadableShapeScoreMap = [
        'Rock' => 1,
        'Paper' => 2,
        'Scissors' => 3
    ];

    public function __construct(string $playerOne, string $playerTwo)
    {
        $this->playerOne = $playerOne;
        $this->playerTwo = $playerTwo;
    }

    public function resultFirstTask(): int
    {
        if ($this->playerOne === $this->playerTwo) {
            return 3;
        }

        $move = $this->playerOne . ' ' . $this->playerTwo;

        return $this->decisionMap[$move];
    }

    public function resultSecondTask(): int
    {
        //draw
        if ($this->playerTwo === 'Y') {
            return $this->humanReadableShapeScoreMap[$this->playerOne] + 3;
        }

        //loose
        if ($this->playerTwo === 'X') {
            return $this->humanReadableShapeScoreMap[$this->getLoosingMove()] + 0;
        }

        //win
        if ($this->playerTwo === 'Z') {
            return $this->humanReadableShapeScoreMap[$this->getWinningMove()] + 6;
        }

        return 0;
    } 

    private function getLoosingMove(): string
    {
        return array_search ($this->playerOne, $this->winMatches);
    }

    private function getWinningMove(): string
    {
        return $this->winMatches[$this->playerOne];
    }
}

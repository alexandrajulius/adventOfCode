<?php

declare(strict_types = 1);

namespace aoc2023\Day02;

final class Game {

    public string $unformated;
    public array $setsMaxRed = [];
    public array $setsMaxGreen = [];
    public array $setsMaxBlue = [];

    public int $maxRed = 0;
    public int $maxGreen = 0;
    public int $maxBlue = 0;
    public int $id = 0;

    private const CONFIG = [
        'red' => 12,
        'green' => 13,
        'blue' => 14
    ];

    public static function from(string $line): self
    {
        $game = new self();
        $game->unformated = $line;

        $trimmed = substr($line, strpos($line, ':') + 2);
        $gameSets = explode('; ', $trimmed);
        foreach ($gameSets as $set) {
            $cubes = explode(',', $set);
            foreach ($cubes as $cube) {
                $red = strpos($cube, 'red');
                if($red !== false) {
                    $game->maxRed += (int) filter_var($cube, FILTER_SANITIZE_NUMBER_INT);
                }
                $green = strpos($cube, 'green');
                if($green !== false) {
                    $game->maxGreen += (int) filter_var($cube, FILTER_SANITIZE_NUMBER_INT);
                }
                $blue = strpos($cube, 'blue');
                if($blue !== false) {
                    $game->maxBlue += (int) filter_var($cube, FILTER_SANITIZE_NUMBER_INT);
                }
            }
            $game->setsMaxRed[] = $game->maxRed;
            $game->setsMaxGreen[] = $game->maxGreen;
            $game->setsMaxBlue[] = $game->maxBlue;
            $game->maxRed = 0;
            $game->maxGreen = 0;
            $game->maxBlue = 0;
        }  

        return $game;
    }

    public function isPossible(): bool
    {
        foreach ($this->setsMaxRed as $score) {
            if ($score > self::CONFIG['red']) {
                return false;
            }
        }

        foreach ($this->setsMaxGreen as $score) {
            if ($score > self::CONFIG['green']) {
                return false;
            }
        }

        foreach ($this->setsMaxBlue as $score) {
            if ($score > self::CONFIG['blue']) {
                return false;
            }
        }
        
        return true;
    }
}
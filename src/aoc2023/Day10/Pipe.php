<?php

declare(strict_types = 1);

namespace aoc2023\Day10;

class Pipe {

    public const NORTH = 'N';
    public const EAST = 'E';
    public const SOUTH = 'S';
    public const WEST = 'W';
    public const DIRECTIONS = [
        self::EAST, self::SOUTH, self::WEST, self::NORTH
    ];
    
    public string $original = '';
    public string $slotA = '';
    public string $slotB = '';
    public int $lineIndex = 0;
    public int $pipeIndex = 0;
    public int $uid = 0;

    public const PIPE_MAP = [
        '|' => [self::NORTH, self::SOUTH], 
        '-' => [self::WEST, self::EAST], 
        'L' => [self::NORTH, self::EAST], 
        'J' => [self::NORTH, self::WEST], 
        '7' => [self::WEST, self::SOUTH], 
        'F' => [self::EAST, self::SOUTH], 
        'S' => ['End', 'Start'],
        '.' => ['.', '.']
    ];

    public static function from(int $lineIndex, int $pipeIndex, string $raw, int $uid): self
    {
        $pipe = new self();
        $pipe->original = $raw;
        $pipe->slotA = self::PIPE_MAP[$raw][0];
        $pipe->slotB = self::PIPE_MAP[$raw][1];
        $pipe->lineIndex = $lineIndex;
        $pipe->pipeIndex = $pipeIndex;
        $pipe->uid = $uid;
        
        return $pipe;
    }

    public function canConnectWith(Pipe $neighbour): bool
    {
        $connectivityRules = [
            'S' => [
                ['isLocatedAbove', 'isPipeFOrSeven'],
                ['isLocatedLeft', 'isDashSevenOrJ'],
                ['isLocatedBelow', 'isPipeLorJ'],
                ['isLocatedLeft', 'isDashLorF'],
            ],
            '7' => [
                ['isLocatedBelow', 'isPipeLorJ'],
                ['isLocatedLeft', 'isDashLorF'],
            ],
            'F' => [
                ['isLocatedBelow', 'isPipeLorJ'],
                ['isLocatedRight', 'isDashSevenOrJ'],
            ],
            'J' => [
                ['isLocatedAbove', 'isPipeFOrSeven'],
                ['isLocatedLeft', 'isDashLorF'],
            ],
            'L' => [
                ['isLocatedAbove', 'isPipeFOrSeven'],
                ['isLocatedRight', 'isDashSevenOrJ'],
            ],
            '|' => [
                ['isLocatedBelow', 'isPipeLorJ'],
                ['isLocatedAbove', 'isPipeFOrSeven'],
            ],
            '-' => [
                ['isLocatedLeft', 'isDashLorF'],
                ['isLocatedRight', 'isDashSevenOrJ'],
            ],
        ];

        foreach ($connectivityRules[$this->original] as [$locationCheck, $typeCheck]) {
            if ($this->$locationCheck($neighbour) && $this->$typeCheck($neighbour)) {
                return true;
            }
        }

        return false;
    }

    private function isLocatedBelow(Pipe $neighbour): bool
    {
        return $neighbour->lineIndex > $this->lineIndex;
    }

    private function isLocatedAbove(Pipe $neighbour): bool
    {
        return $neighbour->lineIndex < $this->lineIndex;
    }

    private function isLocatedRight(Pipe $neighbour): bool
    {
        return $neighbour->pipeIndex > $this->pipeIndex;
    } 

    private function isLocatedLeft(Pipe $neighbour): bool
    {
        return $neighbour->pipeIndex < $this->pipeIndex;
    } 

    private function isPipeLorJ(Pipe $neighbour): bool
    {
        return $neighbour->original === '|' || $neighbour->original === 'L' || $neighbour->original === 'J';
    }

    private function isPipeFOrSeven(Pipe $neighbour): bool
    {
        return $neighbour->original === '|' || $neighbour->original === 'F' || $neighbour->original === '7';
    }

    private function isDashLorF(Pipe $neighbour): bool
    {
        return $neighbour->original === '-' || $neighbour->original === 'L' || $neighbour->original === 'F';
    }

    private function isDashSevenOrJ($neighbour): bool
    {
        return $neighbour->original === '-' || $neighbour->original === '7' || $neighbour->original === 'J';
    }

    public function isEnd(): bool
    {
        return $this->slotA === 'End';
    }

    public function isStart(): bool
    {
        return $this->slotB === 'Start';
    }

    public function isPipe(): bool
    {
        return $this->original !== '.';
    }
}
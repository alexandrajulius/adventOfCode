<?php

declare(strict_types = 1);

namespace aoc2023\Day10;

use function aoc2023\Day10;

class Maze {

    /** @var Line[] */
    public array $lines = [];
    public int $startLineIndex = 0;
    public int $startPipeIndex = 0;
    public array $path = [];

    public static function from(array $input): self
    {
        $maze = new self();
        $pipeUid = 0;
        foreach ($input as $lineIndex => $raw) {
            $rawLine = str_split($raw);
            $line = [];
            foreach ($rawLine as $pipeIndex => $element) {
                if ($element === 'S') {
                    $maze->startLineIndex = $lineIndex;
                    $maze->startPipeIndex = $pipeIndex;
                }
                $line[] = Pipe::from($lineIndex, $pipeIndex, $element, $pipeUid);
                $pipeUid++;
            }
            $maze->lines[] = $line; 
        }

        return $maze;
    }
    
    public function traverse(): array
    {
        $currentPipe = $this->lines[$this->startLineIndex][$this->startPipeIndex];
        $this->path[] = $currentPipe;
        while ($currentPipe->slotA !== 'Stop') {
            $neighbourPipes = $this->getNeighbours($currentPipe->lineIndex, $currentPipe->pipeIndex);
            $nextPipe = $this->nextPipe($currentPipe, $neighbourPipes);     
            $this->path[] = $nextPipe;
            $currentPipe = $nextPipe;  
        }

        return $this->path;
    }

    private function getNeighbours(int $lineIndex, int $pipeIndex): array
    {
        $finalPipe = $this->length() - 1;
        $finalLine = $this->hight() - 1;

        $neighbours = [];
        if ($pipeIndex < $finalPipe) {
            $neighbours[] = $this->lines[$lineIndex][$pipeIndex + 1];
        }

        if ($lineIndex < $finalLine) {
            $neighbours[] = $this->lines[$lineIndex + 1][$pipeIndex];
        }

        if ($pipeIndex > 0) {
            $neighbours[] = $this->lines[$lineIndex][$pipeIndex - 1];
        }

        if ($lineIndex > 0) {
            $neighbours[] = $this->lines[$lineIndex - 1][$pipeIndex];
        }

        return array_filter($neighbours);
    }

    private function nextPipe(Pipe $pipe, array $neighbours): ?Pipe
    {
        
        if ($pipe->isStart()) {
            $options = [];
            foreach ($neighbours as $neighbour) {
                if ($neighbour->isPipe() && $pipe->canConnectWith($neighbour)) {
                    $options[] = $neighbour;
                }                    
            }
            $sorted = $this->sortStartNeighbours($options);
            return $sorted[0];
        }
       

        foreach ($neighbours as $neighbour) {
            if ($neighbour->isPipe()) {
                if ($pipe->canConnectWith($neighbour) && !$this->hasAlreadyBeenVisited($neighbour)) {
                    return $neighbour;
                }

                if ($neighbour->isEnd() && count($this->path) > 2) {
                    $neighbour->slotA = 'Stop';
                    return $neighbour;
                }
            }
        }

        return null;
    }

    private function hasAlreadyBeenVisited(Pipe $pipe): bool
    {
        // oh god
        foreach ($this->path as $alreadyVisited) {
            if ($pipe->uid === $alreadyVisited->uid) {
                return true;
            }
        }

        return false;
    }

    private function length(): int
    {
        return count($this->lines[0]);
    }

    private function hight(): int
    {
        return count($this->lines);
    }

    public function sortStartNeighbours(array $options): array
    {
        usort($options, function ($first, $second) {
            if ($first->pipeIndex === $second->pipeIndex) {
                return $this->compareLine($first, $second);
            } else {
                return $second->pipeIndex - $first->pipeIndex;
            }
        });
    
        return $options;
    }
    
    private function compareLine(Pipe $first, Pipe $second): int
    {
        return $first->lineIndex - $second->lineIndex;
    }
   
}
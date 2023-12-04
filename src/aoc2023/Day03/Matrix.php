<?php

declare(strict_types = 1);

namespace aoc2023\Day03;

final class Matrix {

    public array $lines = [];

    public static function from(array $input): self
    {
        $matrix = new self();
        foreach ($input as $key => $line) {
            $matrix->lines[] = Line::from($line);
        }

        return $matrix;
    }

    public function getPartNumbers(): array
    {
        $partNumbers = [];
    
        foreach ($this->lines as $key => $line) {
            $previousLine = $key > 0 ? $this->lines[$key - 1] : null;
            $nextLine = $key < count($this->lines) - 1 ? $this->lines[$key + 1] : null;
    
            foreach ($line->digits as $index => $digitEntry) {
                $digit = key($digitEntry);
                $digitIndexStart = array_pop(array_reverse($digitEntry[$digit]));
                $digitIndexEnd = array_pop($digitEntry[$digit]);
    
                $isAdjacentWithinLine = $this->isAdjacentToLine($line->symbols, $digitIndexStart, $digitIndexEnd);
                $isAdjacentToPreviousLine = $previousLine && $this->isAdjacentToLine($previousLine->symbols, $digitIndexStart, $digitIndexEnd);
                $isAdjacentToNextLine = $nextLine && $this->isAdjacentToLine($nextLine->symbols, $digitIndexStart, $digitIndexEnd);
    
                if ($this->isFirstLine($key) && ($isAdjacentWithinLine || $isAdjacentToNextLine)) {
                    $partNumbers[] = $digit;
                    $line->digits[$index]['isPartNumber'] = true;
                }
    
                if ($this->isLastLine($key) && ($isAdjacentWithinLine || $isAdjacentToPreviousLine)) {
                    $partNumbers[] = $digit;
                    $line->digits[$index]['isPartNumber'] = true;
                }
    
                if ($this->otherLines($key) && ($isAdjacentWithinLine || $isAdjacentToPreviousLine || $isAdjacentToNextLine)) {
                    $partNumbers[] = $digit;
                    $line->digits[$index]['isPartNumber'] = true;
                }
            }
        }
    
        return $partNumbers;
    }
    

    public function getGearRatio(): array
    {
        $gearRatio = [];
        $createPartNumbers = $this->getPartNumbers();
        $asterisks = [];
        foreach ($this->lines as $key => $line) {
            if ($this->otherLines($key)) {
                $previousLine = $this->lines[$key - 1] ?? null;
                $nextLine = $this->lines[$key + 1] ?? null;
                foreach ($line->asterisks as $asteriskIndex) {
                    $asterisk = new Asterisk($asteriskIndex, 0, []);
                    $this->processAsterisk($asterisk, $line->digits);
                    $this->processAsterisk($asterisk, $previousLine->digits);
                    $this->processAsterisk($asterisk, $nextLine->digits);
                  
                    $asterisks[] = $asterisk;
                }
            }
        }

        return $asterisks;
    }

    private function processAsterisk(Asterisk $asterisk, array $digits): void
    {
        foreach ($digits as $digitIndexes) {
            $digit = array_key_first($digitIndexes);
            $digitIndexStart = array_pop(array_reverse($digitIndexes[$digit]));
            $digitIndexEnd = array_pop($digitIndexes[$digit]);
            if ($this->isAdjacentToSymbol($asterisk->index, $digitIndexStart, $digitIndexEnd)
                && $digitIndexes['isPartNumber'] === true) {
                    $asterisk->adjacentPartNumbersCount += 1;
                    $asterisk->adjacentPartNumbers[] = $digit;
            }
        }
    }

    private function isFirstLine($key): bool
    {
        return $key === 0;
    }

    private function isLastLine($key): bool
    {
        return $key === count($this->lines) - 1;
    }

    private function otherLines($key): bool
    {
        return $key !== 0 && $key !== count($this->lines) - 1;
    }

    private function isAdjacentToLine(array $symbolIndexes, int $digitIndexStart, int $digitIndexEnd): bool
    {
        foreach ($symbolIndexes as $symbolIndex) {
            if ($this->isAdjacentToSymbol($symbolIndex, $digitIndexStart, $digitIndexEnd)) {
                return true;
            }
        } 

        return false;
    }

    private function isAdjacentToSymbol($symbolIndex, $digitIndexStart, $digitIndexEnd): bool
    {
        return $symbolIndex >= $digitIndexStart - 1 && $symbolIndex <= $digitIndexEnd + 1;
    }

}
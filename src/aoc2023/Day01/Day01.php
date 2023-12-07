<?php

declare(strict_types = 1);

namespace aoc2023\Day01;

final class Day01
{ 
    public function partOne(string $input): int
    {
        $calibrationDoc = $this->toArray($input);
        $calibrationValues = [];
       
        foreach ($calibrationDoc as $line) {            
            $lineAsArray = str_split($line);
            $firstDigit = $this->getFirstDigit($lineAsArray);

            $reverse = array_reverse($lineAsArray);
            $lastDigit = $this->getFirstDigit($reverse);

            $calibrationValues[] = $firstDigit . $lastDigit; 
        }
        
        return array_sum($calibrationValues);
    }

    public function partTwo(string $input): int
    {
        $calibrationDoc = $this->toArray($input);
        $calibrationValues = [];
        foreach ($calibrationDoc as $line) {            
            $wordMap = Wordmap::from($line);
            $calibrationValues[] = $wordMap->findFirstDigit() . $wordMap->findLastDigit();   
        }

        return array_sum($calibrationValues);
    }

    /**
     * @return string[]|bool
     */
    private function toArray(string $input): array
    {
        return explode(PHP_EOL, preg_replace('/[ ]{2,}|[\t]/', '', trim($input)));
    }

    private function getFirstDigit(array $line): int
    {
        foreach ($line as $char) {
            if (is_numeric($char)) {
                return (int)$char;
            }
        }

        return 0;
    }
}
<?php

declare(strict_types = 1);

namespace aoc2023\Day01;

final class Day01
{ 
    private const WORDS = [
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9
    ];

    public function firstTask(string $input): int
    {
        $calibrationDoc = $this->getArrayOfStrings($input);
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

    public function secondTask(string $input): int
    {
        $calibrationDoc = $this->getArrayOfStrings($input);
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
    private function getArrayOfStrings(string $input): array
    {
        $trimmed = preg_replace('/[ ]{2,}|[\t]/', '', trim($input));

        return explode(PHP_EOL, $trimmed);
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
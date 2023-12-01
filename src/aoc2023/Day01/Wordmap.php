<?php

declare(strict_types = 1);

namespace aoc2023\Day01;

final class Wordmap {

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

    public string $line;
    public array $wordsPerLine = [];

    public static function from(string $line): self
    {
        $wordMap = new self();
        $wordMap->line = $line;

        $wordsPerLine = [];
        foreach (self::WORDS as $key => $value) {
            $allPositions = self::getAllPositions($line, $key);
            if (!empty($allPositions)) {
                foreach ($allPositions as $pos) {
                    $word = new Word($key, $pos);
                    $wordMap->wordsPerLine[] = $word;
                }
            }
        }
        
        return $wordMap;
    }

    private static function getAllPositions($haystack, $needle):  array 
    {
        $offset = 0;
        $allpos = [];
        while (($pos = strpos($haystack, $needle, $offset)) !== false) {
            $offset   = $pos + 1;
            $allpos[] = $pos;
        }

        return $allpos;
    }

    public function findFirstDigit(): int
    {
        $minPos = INF;
        $firstWord = null;
        foreach ($this->wordsPerLine as $word) {
            if ($word->position < $minPos) {
                $minPos = $word->position;
                $firstWord = $word;
            }
        }

        if ($firstWord === null) {
            return $this->getFirstDigit($this->line);
        }

        $finalDigit = 0;
        if ($firstWord->position > 0) {
            $leadingChars = substr($this->line, 0, $firstWord->position);

            $finalDigit = $this->getFirstDigit($leadingChars);
        }
        
      return ($finalDigit !== 0) ? $finalDigit : self::WORDS[$firstWord->word];
    }

    public function findLastDigit(): int
    {
        $maxPos = 0;
        $lastWord = null;
        foreach ($this->wordsPerLine as $word) {
            if ($word->position > $maxPos) {
                $maxPos = $word->position;
                $lastWord = $word;
            }
        }

        if ($lastWord === null) {
            return $this->getFirstDigit(strrev($this->line));
        }

        //wow php, you are one special kid
        $lineLength = strlen($this->line);
        $lastIndex = $lastWord->position;
        $finalChars = $lineLength - $lastIndex;

        $finalSubstring = substr($this->line, -$finalChars);

        $finalDigit = $this->getFirstDigit(strrev($finalSubstring));

        return ($finalDigit !== 0) ? $finalDigit : self::WORDS[$lastWord->word];
    }

    private function getFirstDigit(string $chars): int 
    {
        $stringAsArray = str_split($chars);
        foreach ($stringAsArray as $char) {
            if (is_numeric($char)) {
                return (int)$char;
            }
        }

        return 0;
    }
}
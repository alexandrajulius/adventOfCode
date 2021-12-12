<?php

declare(strict_types = 1);

namespace aoc2021\Day10;

final class Day10
{
    public const GRAMMAR = [
        '(' => ')',
        '[' => ']',
        '{' => '}',
        '<' => '>'
    ];

    public const CHAR_SCORES = [
        ')' => 3,
        ']' => 57,
        '}' => 1197,
        '>' => 25137
    ];

    public const SECOND_CHAR_SCORES = [
        ')' => 1,
        ']' => 2,
        '}' => 3,
        '>' => 4
    ];

    public function firstTask(string $input): int
    {
        $lines = $this->getLines($input);
        $scores = [];
        foreach ($lines as $line) {
            $scores[] = $this->checkCorrupted($line);
        }

        return array_sum($scores);
    }

    public function secondTask(string $input): int
    {
        $lines = $this->getLines($input);
        $incompletes = $this->getIncompleteLines($lines);

        $completions = array_map(function(string $line): string {
            return $this->complete($line);
        }, $incompletes);

        $scores = array_map(function(string $completion): int {
            return $this->getScore($completion);
        }, $completions);

        asort($scores);

        $resetKeys = [];
        foreach ($scores as $score) {
            $resetKeys[] = $score;
        }

        return $resetKeys[count($resetKeys) / 2];
    }

    private function getScore(string $completion): int
    {
        $chars = str_split($completion, 1);
        $score = 0;
        foreach ($chars as $char) {
            $score *= 5;
            $score += self::SECOND_CHAR_SCORES[$char];
        }

        return $score;
    }

    private function getLines(string $input): array
    {
        return explode("\n", $input);
    }

    private function complete(string $incomplete): string
    {
        $chars = str_split($incomplete, 1);
        $stack = [];
        foreach ($chars as $char) {
            if (array_key_exists($char, self::GRAMMAR)) {
                $stack[] = $char;
            }
            if (in_array($char, self::GRAMMAR, true)) {
                array_pop($stack);
            }
        }
        $completion = [];
        foreach ($stack as $item) {
            $completion[] = self::GRAMMAR[$item];
        }
        $reversed = array_reverse($completion);

        return implode('', $reversed);
    }

    private function getIncompleteLines($lines): array
    {
        $incompletes = [];
        foreach ($lines as $line) {
            if ($this->checkCorrupted($line) === 0) {
                $incompletes[] = $line;
            }
        }

        return $incompletes;
    }

    private function checkCorrupted(string $line): int
    {
        $chars = str_split($line, 1);
        $stack = [];
        foreach ($chars as $char) {
            if (array_key_exists($char, self::GRAMMAR)) {
                $stack[] = $char;
            }

            if (in_array($char, self::GRAMMAR, true)) {
                $last = array_pop($stack);
                if ($last !== array_search($char, self::GRAMMAR, true)) {
                    return self::CHAR_SCORES[$char];
                }
            }
        }

        return 0;
    }
}

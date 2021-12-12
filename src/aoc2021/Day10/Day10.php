<?php

declare(strict_types = 1);

namespace aoc2021\Day10;

final class Day10
{
    public array $bracketMap = [
        '(' => ')',
        '[' => ']',
        '{' => '}',
        '<' => '>'
    ];

    public array $charScores = [
        ')' => 3,
        ']' => 57,
        '}' => 1197,
        '>' => 25137
    ];

    public array $secondTaskCharScores = [
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
            $score += $this->secondTaskCharScores[$char];
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
            if (array_key_exists($char, $this->bracketMap)) {
                $stack[] = $char;
            }
            if (in_array($char, $this->bracketMap, true)) {
                array_pop($stack);
            }
        }
        $completion = [];
        foreach ($stack as $item) {
            $completion[] = $this->bracketMap[$item];
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
            if (array_key_exists($char, $this->bracketMap)) {
                $stack[] = $char;
            }

            if (in_array($char, $this->bracketMap, true)) {
                $last = array_pop($stack);
                if ($last !== array_search($char, $this->bracketMap, true)) {
                    return $this->charScores[$char];
                }
            }
        }

        return 0;
    }
}

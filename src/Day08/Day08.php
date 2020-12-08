<?php

declare(strict_types=1);

namespace Day08;

final class Day08
{
    // Fix game console
    public function getLastAccValueFromFixedInstructions(string $rawInput): int
    {
        $instructions = $this->convertInput($rawInput);

        $result = $this->getMemorizedRun($instructions);

        $bla = [];
        foreach ($result[2] as $i) {
            $copy = $instructions;

            if ($copy[$i][0] == 'nop') {
                $copy[$i][0] = 'jmp';
                $bla = $this->getMemorizedRun($copy);
            } else {
                if ($copy[$i][0] == 'jmp') {
                    $copy[$i][0] = 'nop';
                    $bla = $this->getMemorizedRun($copy);
                }
            }

            if ($bla[0] == count($instructions)) {
                return $bla[1];
            }
        }

        return 1;
    }

    private function getMemorizedRun($instructions): array
    {
        $visited = [];
        $history = [];
        $accCounter = 0;
        $i = 0;
        while (!in_array($i, $visited) && ($i < count($instructions))) {
            array_push($visited, $i);
            [$i, $accCounter, $history] = $this->runInstructionAndMemorizeRun($instructions, $accCounter, $i, $history);
        }

        return [$i, $accCounter, $history];
    }


    public function runInstructionAndMemorizeRun(array $instructions, int $accCounter, $i, $history): array
    {
        if ($instructions[$i][0] === 'nop') {
            array_push($history, $i);
            return [$i + 1, $accCounter, $history];
        }

        if ($instructions[$i][0] === 'acc') {
            $accCounter = $this->calculateCount($instructions[$i][1], $accCounter);
            array_push($history, $i);
            return [$i + 1, $accCounter, $history];
        }

        if ($instructions[$i][0] === 'jmp') {
            $jumpToIndex = $this->calculateCount($instructions[$i][1], $i);
            array_push($history, $i);
            return [$jumpToIndex, $accCounter, $history];
        }

        return [];
    }


    public function getLastAccValue(string $rawInput): int
    {
        $instructions = $this->convertInput($rawInput);

        $visited = [];
        $accCounter = 0;
        $i = 0;
        while (!in_array($i, $visited)) {
            array_push($visited, $i);
            [$i, $accCounter] = $this->runInstruction($instructions, $accCounter, $i);
        }

        return $accCounter;
    }

    public function runInstruction(array $instructions, int $accCounter, $i): array
    {
        if ($instructions[$i][0] === 'nop') {
            return [$i + 1, $accCounter];
        }

        if ($instructions[$i][0] === 'acc') {
            $accCounter = $this->calculateCount($instructions[$i][1], $accCounter);
            return [$i + 1, $accCounter];
        }

        if ($instructions[$i][0] === 'jmp') {
            $jumpToIndex = $this->calculateCount($instructions[$i][1], $i);
            return [$jumpToIndex, $accCounter];
        }

        return [];
    }

    private function calculateCount(string $operation, int $first): int
    {
        $mathOp = substr($operation, 0, 1);
        $second = substr($operation, 1);

        if ($mathOp === '+') {
            return $first + (int)$second;
        }

        if ($mathOp === '-') {
            return $first - (int)$second;
        }

        return 0;
    }

    private function convertInput(string $rawInput): array
    {
        $rawInstructions = explode("\n", $rawInput);

        $instructions = [];
        foreach ($rawInstructions as $instruction) {
            $instructions[] = explode(' ', $instruction);
        }

        return $instructions;
    }
}
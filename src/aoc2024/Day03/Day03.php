<?php

declare(strict_types = 1);

namespace aoc2024\Day03;

final class Day03
{
    public function partOne(string $input): int
    {
        $instructions = $this->getInstructionsPartOne($input);
        $product = 0;
        foreach ($instructions as $instruction) {
            $factorList = $this->getFactorList($instruction);
            $product += $factorList[0] * $factorList[1];
        }

        return $product;
    }

    /**
     * Have cheated by prepending every input string with 'do()'
     * so I wouldn't have to deal with determining the first do instructions
     */
    public function partTwo(string $input): int
    {
        $instructions = $this->getInstructionsPartTwo($input);
        $doInstructions = $this->getDoInstructions($instructions);

        $product = 0;
        foreach ($doInstructions as $doInstruction) {
            $factorList = $this->getFactorList($doInstruction);
            $product += $factorList[0] * $factorList[1];
        }

        return $product;
    }

    /**
     * @return string[]
     */
    private function getDoInstructions(array $instructions): array
    {
        $doInstructions = [];
        $include = false;
        foreach ($instructions as $element) {
            if ($element === 'do()') {
                $include = true;
                continue;
            }

            if ($element === 'don\'t()') {
                $include = false;
                continue;
            }

            if ($include) {
                $doInstructions[] = $element;
            }
        }

        return $doInstructions;
    }

    /**
     * @return string[]
     */
    private function getInstructionsPartOne(string $input): array
    {
        $pattern = '/mul\(\d{1,3},\d{1,3}\)/';
        preg_match_all($pattern, $input, $matches);

        return $matches[0];
    }

    /**
     * @return string[]
     */
    private function getInstructionsPartTwo(string $input): array
    {
        $pattern = '/do\(\)|don\'t\(\)|mul\(\d{1,3},\d{1,3}\)/';
        preg_match_all($pattern, $input, $matches);

        return $matches[0];
    }

    /**
     * @return int[]
     */
    public function getFactorList(string $instruction): array
    {
        $cleanInst = str_replace('mul(', '', $instruction);
        $cleanerInst = str_replace(')', '', $cleanInst);

        return array_map('intval', explode(',', $cleanerInst));
    }
}

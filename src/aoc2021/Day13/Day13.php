<?php

declare(strict_types = 1);

namespace aoc2021\Day13;

final class Day13
{
    public function firstTask(string $input): int
    {
        $split = $this->extractFoldAndGrid($input);

        $paperGrid = Grid::create($split[0]);
        $folds = $this->getFoldList($split[1]);
        $paperGrid->fold($folds[0]);

        foreach ($folds as $fold) {
     #       var_dump($fold);
     #       $paperGrid->fold($fold);
        }

        return $paperGrid->countHashes();
    }

    private function extractFoldAndGrid(string $input): array
    {
        return explode("\n\n", $input);
    }

    private function getFoldList(string $input): array
    {
        $inputArr = explode("\n", $input);
        $folds = [];
        foreach ($inputArr as $foldString) {
            $extract = str_replace('fold along ', '', $foldString);
            $folds[] = Fold::create($extract);
        }

        return $folds;
    }
}

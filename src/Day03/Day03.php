<?php

declare(strict_types=1);

namespace Day03;

final class Day03
{
    // Tree Traversal
    public function getProductOfDifferentTraversals(array $treeGrid): int
    {
        $rightOneDownOne = $this->getAmountOfTrees(1, $treeGrid);
        $rightThreeDownOne = $this->getAmountOfTrees(3, $treeGrid);
        $rightFiveDownOne = $this->getAmountOfTrees(5, $treeGrid);
        $rightSevenDownOne = $this->getAmountOfTrees(7, $treeGrid);
        $rightOneDownTwo = $this->getAmountOfTrees(1, $this->removeEverySecondRow($treeGrid));

        return $rightOneDownOne
            * $rightThreeDownOne
            * $rightFiveDownOne
            * $rightSevenDownOne
            * $rightOneDownTwo;
    }

    public function getAmountOfTrees(int $stepsToTheRight, array $treeGrid): int
    {
        $count = 0;
        $index = 0;
        foreach ((array)$treeGrid as $i => $grid) {
            $indexedGrid = str_split($grid);

            $tree = ($indexedGrid[$index] == '#') ? 1 : 0;
            $count = $count + $tree;
            $index = (($index + $stepsToTheRight) % count($indexedGrid));
        }

        return $count;
    }

    private function removeEverySecondRow(array $treeGrid): array
    {
        $size = count($treeGrid);
        $result = array();
        for ($i = 0; $i < $size; $i += 2) {
            $result[] = $treeGrid[$i];
        }
        return $result;
    }
}
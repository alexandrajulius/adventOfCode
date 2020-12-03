<?php

declare(strict_types=1);

final class DayThree
{
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

    public function getAmountOfTrees(int $steps, array $treeGrid): int
    {
        $count = 0;
        $index = 0;
        foreach ((array)$treeGrid as $i => $grid) {
            $indexedGrid = str_split($grid);

            $tree = ($indexedGrid[$index] == '#') ? 1 : 0;
            $count = $count + $tree;
            $index = (($index + $steps) % count($indexedGrid));

            // 6  / 31 = 0 rest 6
            // 30 / 31 = 0 rest 30
            // 33 / 31 = 1 rest 2
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
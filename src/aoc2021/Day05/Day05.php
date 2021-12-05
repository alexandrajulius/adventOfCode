<?php

declare(strict_types = 1);

namespace aoc2021\Day05;

final class Day05
{
    public function firstTask(string $input): int
    {
        $diagram = $this->getDiagram($input, 'task1');

        return $diagram->getAmountOfCrossingLines();
    }

    public function secondTask(string $input): int
    {
        $diagram = $this->getDiagram($input, 'task2');

        return $diagram->getAmountOfCrossingLines();
    }

    private function getDiagram(string $input, string $task): Diagram
    {
        $linesOfVents = explode("\n", $input);
        $vents = [];
        foreach ($linesOfVents as $vent) {
            $vents[] = explode(' -> ', $vent);
        }

        return Diagram::create($vents, $task);
    }
}

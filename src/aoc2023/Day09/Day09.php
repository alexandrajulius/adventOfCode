<?php

declare(strict_types = 1);

namespace aoc2023\Day09;

final class Day09
{
    public function partOne(string $input): int
    {
        $report = OasisReport::from($input);
        return $report->nextValuesSum();
    }

    public function partTwo(string $input): int
    {
        $report = OasisReportPartTwo::from($input);
        return $report->nextValuesSum();
    }
}
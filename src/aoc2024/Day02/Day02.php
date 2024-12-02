<?php

declare(strict_types = 1);

namespace aoc2024\Day02;

final class Day02
{
    public function partOne(string $input): int
    {
        $reportCollection = ReportCollection::from($this->toArray($input));

        return $reportCollection->getSaveReportsCount();
    }

    public function partTwo(string $input): int
    {
        $reportCollection = ReportCollection::from($this->toArray($input));

        return $reportCollection->getDampenedSaveReportsCount();
    }

    /**
     * @return string[]|bool
     */
    private function toArray(string $input): array
    {
        return explode(PHP_EOL, $input);
    }
}

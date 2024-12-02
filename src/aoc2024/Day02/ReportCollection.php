<?php

declare(strict_types=1);

namespace aoc2024\Day02;

class ReportCollection
{
    public array $reports = [];

    /**
     * @param string[] $rawReports
     */
    public static function from(array $rawReports): self
    {
        $reportCollection = new self();
        foreach ($rawReports as $rawLevel) {
            if ($rawLevel !== '') {
                $reportCollection->reports[] = Report::from($rawLevel);
            }
        }

        return $reportCollection;
    }

    public function getSaveReportsCountProblemDampened(): int
    {
        $count = 0;
        foreach ($this->reports as $report) {
            if ($report->isSafelyIncreasing()) {
                $count++;
            }

            if ($report->isSafelyDecreasing()) {
                $count++;
            }
        }

        return $count;
    }

    public function getSaveReportsCount(): int
    {
        $count = 0;
        foreach ($this->reports as $report) {
            if ($report->isSafelyIncreasing()) {
                $count++;
            }

            if ($report->isSafelyDecreasing()) {
                $count++;
            }
        }
        return $count;
    }
}

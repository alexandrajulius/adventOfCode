<?php

declare(strict_types=1);

namespace aoc2024\Day02;

class Report
{
    /**
     * @var int[]
     */
    public array $levels = [];

    public static function from(string $rawReport): self
    {
        $report = new self();
        $report->levels = array_map('intval', explode(' ', $rawReport));
        return $report;
    }

    public function isSafelyIncreasing(): bool
    {
        for ($i = 0; $i <= count($this->levels) - 2; $i++) {
            $dist = $this->levels[$i+1] - $this->levels[$i];
            if (!($dist >= 1 && $dist <= 3)) {
                return false;
            }
        }

        return true;
    }

    public function isSafelyDecreasing(): bool
    {
        for ($i = 0; $i <= count($this->levels) - 2; $i++) {
            $dist = $this->levels[$i] - $this->levels[$i+1];
            if (!($dist >= 1 && $dist <= 3)) {
                return false;
            }
        }

        return true;
    }

    public function isIncreasingIfDampened(): bool
    {
        for ($i = 0; $i <= count($this->levels) - 1; $i++) {
            $levelCopy = $this->levels;
            array_splice($levelCopy, 1, 1);
            if ($this->isSafelyIncreasing()) {
                return true;
            }
        }

        return false;
    }
}

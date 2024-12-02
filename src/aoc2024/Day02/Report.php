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

    public function isDampened(): bool
    {
        for ($i = 0; $i <= count($this->levels) - 1; $i++) {
            $levelsCopy = $this->levels;
            array_splice($levelsCopy, $i, 1);
            if ($this->isIncreasing($levelsCopy)) {
                return true;
            }
            if ($this->isDecreasing($levelsCopy)) {
                return true;
            }
        }

        return false;
    }

    private function isIncreasing(array $levelsCopy): bool
    {
        for ($i = 0; $i <= count($levelsCopy) - 2; $i++) {
            $dist = $levelsCopy[$i+1] - $levelsCopy[$i];
            if (!($dist >= 1 && $dist <= 3)) {
                return false;
            }
        }

        return true;
    }

    private function isDecreasing(array $levelsCopy): bool
    {
        for ($i = 0; $i <= count($levelsCopy) - 2; $i++) {
            $dist = $levelsCopy[$i] - $levelsCopy[$i+1];
            if (!($dist >= 1 && $dist <= 3)) {
                return false;
            }
        }

        return true;
    }
}

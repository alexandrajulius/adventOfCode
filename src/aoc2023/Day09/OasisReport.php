<?php

declare(strict_types = 1);

namespace aoc2023\Day09;

class OasisReport {

    public string $original = '';
    /** @var Line[] */
    public array $valueHistory = [];

    public static function from(string $input): self
    {
        $report = new self();
        $report->original = $input;
        $report->valueHistory = self::getValueHistory($input);

        return $report;
    }

    public function nextValuesSum(): int
    {
        return array_sum(array_map(function ($line) {
            return $line->getNextValue();
        }, $this->valueHistory));
    }

    protected static function getValueHistory(string $input): array
    {
        $history = [];
        $raw = array_map('trim', explode(PHP_EOL, $input));
        foreach ($raw as $line) {
            $history[] = new Line(array_map(function($item) {
                return intval(trim($item));
            }, explode(' ', $line)));  
        }

        return $history;
    }

}
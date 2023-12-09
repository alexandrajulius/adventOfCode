<?php

declare(strict_types = 1);

namespace aoc2023\Day09;

final class OasisReportPartTwo extends OasisReport {

    public static function from(string $input): self
    {
        $report = new self();
        $report->original = $input;
        $report->valueHistory = self::getValueHistory($input);

        return $report;
    }

    protected static function getValueHistory(string $input): array
    {
        $history = [];
        $raw = array_map('trim', explode(PHP_EOL, $input));
        foreach ($raw as $line) {
            $history[] = new LinePartTwo(array_map(function($item) {
                return intval(trim($item));
            }, explode(' ', $line)));  
        }

        return $history;
    }

}
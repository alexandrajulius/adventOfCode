<?php

declare(strict_types = 1);

namespace aoc2021\Day08;

final class Day08
{
    public function firstTask(string $input): int
    {
        $displayedDigits = $this->getDisplayedDigits($input);
        $count = 0;
        foreach ($displayedDigits as $digits) {
            foreach ($digits as $digit) {
                if (strlen($digit) === 2) {
                    $count++;
                }
                if (strlen($digit) === 4) {
                    $count++;
                }
                if (strlen($digit) === 3) {
                    $count++;
                }
                if (strlen($digit) === 7) {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function secondTask(string $input): int
    {
        $displayedDigits = $this->getDisplayedDigits($input);
        $signalInputs = $this->getSignals($input);

        $count = [];
        foreach ($displayedDigits as $index => $lane) {
            $decoder = new Decoder($signalInputs[$index]);
            $assignments = $decoder->getAssignments();
            $outputNumber = '';
            foreach ($lane as $digit) {
                $arrDigit = str_split($digit, 1);
                foreach ($assignments as $key => $assignment) {
                    if ($this->containSameElements($assignment, $arrDigit)) {
                        $outputNumber .= $key;
                    }
                }
            }
            $count[] = $outputNumber;
        }

        return array_sum($count);
    }

    /**
     * @return array[string[]]
     */
    private function getDisplayedDigits(string $input): array
    {
        $lines = explode("\n", $input);
        $digits = [];
        foreach($lines as $line) {
            $displayedDigits = trim(substr($line, strpos($line, "| ") + 1));
            $digits[] = explode(' ', $displayedDigits);
        }

        return $digits;
    }

    private function getSignals(string $input): array
    {
        $lines = explode("\n", $input);
        $signals = [];
        foreach($lines as $line) {
            $displayedDigits = trim(strtok($line, '|'));
            $signals[] = explode(' ', $displayedDigits);
        }

        return $signals;
    }

    private function containSameElements(array $array1, array $array2): bool
    {
        $bool = true;
        foreach ($array1 as $element) {
            if (!in_array($element, $array2, true)) {
                $bool = false;
            }
        }

        foreach ($array2 as $element) {
            if (!in_array($element, $array1, true)) {
                $bool = false;
            }
        }

        return $bool;
    }
}

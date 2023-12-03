<?php

declare(strict_types = 1);

namespace aoc2023\Day03;

final class Line {

    public string $original = '';
    public array $digits = [];
    public array $symbols = [];
    public array $asterisks = [];
    public int $number = 0;
    public array $index = [];
    
    public static function from(string $input): self
    {
        $line = new self();
        $line->original = $input;
        $chars = str_split($input);
        foreach ($chars as $key => $char) {
            if ($char === '.') {
                if ($line->number !== 0) {
                    $line->digits[] = [$line->number => $line->index];
                }
                $line->number = 0;
                $line->index = [];
            }
            // symbol
            if (!is_numeric($char) && $char !== '.') {
                if ($line->number !== 0) {
                    $line->digits[] = [$line->number => $line->index];
                }
                $line->number = 0;
                $line->index = [];
                if ($char === '*') {
                    $line->asterisks[] = $key;
                }
                $line->symbols[] = $key;
            }
            // digit
            if (is_numeric($char)) {
                $line->number = $line->number === 0 ? $line->number = intval($char) : intval($line->number . $char);
                $line->index[] = $key;
            }
        }

        // get the last digit
        if ($line->number !== 0) {
            $line->digits[] = [$line->number => $line->index];
        }

        return $line;
    }
}
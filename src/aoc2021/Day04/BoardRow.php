<?php

declare(strict_types = 1);

namespace aoc2021\Day04;

class BoardRow
{
    public array $numbers;

    /**
     * @param Number[] $numbers
     */
    public function __construct(array $numbers)
    {
        $this->numbers = $numbers;
    }

    /**
     * @param string[]
     */
    static function createFromString(array $rawNumbers): BoardRow
    {
        $numbers = [];
        foreach($rawNumbers as $value) {
            $numbers[] = new Number($value, false);
        }

        return new BoardRow($numbers);
    }

    public function isMarked(): bool
    {
        foreach($this->numbers as $number) {
            if ($number->isMarked() === false) {
                return false;
            }
        }

        return true;
    }
}

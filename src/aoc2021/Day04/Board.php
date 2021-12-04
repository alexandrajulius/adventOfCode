<?php

declare(strict_types = 1);

namespace aoc2021\Day04;

final class Board
{
    public array $boardRows;
    public string $number;

    public function __construct(array $boardRows)
    {
        $this->boardRows = $boardRows;
    }

    static function createFromString(string $rawRows) {
        $rows = explode("\n", $rawRows);
        $boardRows = [];
        foreach($rows as $row) {
            if ($row !== '') {
                $boardRows[] = BoardRow::createFromString(array_filter(explode(' ', $row),'strlen'));
            }
        }

        return new Board($boardRows);
    }

    /**
     * @return BoardRow[]
     */
    public function getBoardRows(): array
    {
        return $this->boardRows;
    }

    /**
     * @return BoardColumn[]
     */
    public function getBoardColumns(): array
    {
        $columns = [];
        foreach ($this->boardRows as $row) {
            foreach ($row->numbers as $columnIndex => $number) {
                if (!isset($columns[$columnIndex])) {
                    $columns[$columnIndex] = [];
                }
                $columns[$columnIndex][] = $number;
            }
        }

        return array_map(fn (array $numbers) => new BoardColumn($numbers), $columns);
    }

    public function markNumber(string $drawNumber): void
    {
        foreach($this->boardRows as $row) {
            foreach($row->numbers as $number) {
                if ($number->getValue() === $drawNumber) {
                    $number->mark();
                }
            }
        }
    }

    public function getSumOfUnmarkedNumbers(): int
    {
        $unmarked = [];
        foreach($this->boardRows as $row) {
            foreach($row->numbers as $number) {
                if ($number->isMarked() === false) {
                    $unmarked[] = (int)$number->getValue();
                }
            }
        }

        return array_sum($unmarked);
    }
}

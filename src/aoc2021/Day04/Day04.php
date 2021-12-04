<?php

declare(strict_types = 1);

namespace aoc2021\Day04;

final class Day04
{
    public function firstTask(string $input): int
    {
        $drawNumbers = $this->getDrawNumbers($input);
        $boards = $this->getBoards($input);

        foreach($drawNumbers as $drawNumber) {
            foreach($boards as $board) {
                $board->markNumber($drawNumber);
                foreach ($board->getBoardColumns() as $column) {
                    if ($column->isMarked()) {
                        return $drawNumber * $board->getSumOfUnmarkedNumbers();
                    }
                }

                foreach ($board->getBoardRows() as $row) {
                    if ($row->isMarked()) {
                        return $drawNumber * $board->getSumOfUnmarkedNumbers();
                    }
                }
            }
        }

        return 1;
    }

    public function secondTask(string $input): int
    {
        $drawNumbers = $this->getDrawNumbers($input);
        $boards = $this->getBoards($input);

        $winningBoards = [];
        foreach($drawNumbers as $drawNumber) {
            foreach($boards as $key => $board) {
                $board->markNumber($drawNumber);
                foreach ($board->getBoardColumns() as $column) {
                    if ($column->isMarked()) {
                        if (!isset($winningBoards[$key])) {
                            $winningBoards[$key] = $drawNumber * $board->getSumOfUnmarkedNumbers();
                        }
                    }
                }

                foreach ($board->getBoardRows() as $row) {
                    if ($row->isMarked()) {
                        if (!isset($winningBoards[$key])) {
                            $winningBoards[$key] = $drawNumber * $board->getSumOfUnmarkedNumbers();
                        }
                    }
                }
            }
        }

        return end($winningBoards);
    }

    private function getDrawNumbers(string $input): array
    {
        $lastCommaPos = strrpos($input, ',', 0);
        $drawNumbers = substr($input, 0, $lastCommaPos + 2);

        return explode(',', $drawNumbers);
    }

    /**
     * @return Board[]
     */
    private function getBoards(string $input): array
    {
        $lastCommaPos = strrpos($input, ',', 0);
        $boardsAsString = substr($input,$lastCommaPos + 4);
        $splitBoardsAsString = explode("\n\n", $boardsAsString);
        $boardsList = [];
        foreach($splitBoardsAsString as $splitBoard) {
            $boardsList[] = Board::createfromString($splitBoard);
        }

        return $boardsList;
    }
}

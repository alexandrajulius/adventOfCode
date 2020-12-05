<?php

declare(strict_types=1);

final class Day05
{
    // Boarding Passes
    public function findHighestSeatId(string $rawInput): int
    {
        $boardingPasses = explode("\n", $rawInput);

        $seats = [];
        foreach ($boardingPasses as $boardingPass) {
            $seats[] = $this->findSeat($boardingPass);
        }
        rsort($seats);

        return $seats[0];
    }

    public function findSeat(string $boardingPass): int
    {
        $rowBinary = $this->getRowBinary(substr($boardingPass, 0, 7));
        $columnBinary = $this->getColumnBinary(substr($boardingPass, 7, 9));

        return bindec($rowBinary) * 8 + bindec($columnBinary);
    }

    /**
     * 2^7 = 128
     *
     * 1010110
     * 64 32 16 8 4 2 1
     *
     * FBFBBFF
     *
     * 0101100
     *
     * 32 + 8 + 4 = 44
     */
    private function getRowBinary(string $rowFragment): string
    {
        $rowBinaryF = str_replace('F', '0', $rowFragment);
        $rowBinary = str_replace('B', '1', $rowBinaryF);

        return $rowBinary;
    }

    /**
     * 2^2 = 4
     *
     * 101
     * 4 2 1
     *
     * RLR
     *
     * 101
     *
     * 4 + 1 = 5
     */
    private function getColumnBinary(string $rowFragment): string
    {
        $rowBinaryF = str_replace('L', '0', $rowFragment);
        $rowBinary = str_replace('R', '1', $rowBinaryF);

        return $rowBinary;
    }

    public function convertInputData(string $rawInput): array
    {
        $boardingPasses = explode("\n", $rawInput);

        $output = [];
        foreach ($boardingPasses as $boardingPass) {
            $output[] = [str_replace("\n", ' ', $boardingPass)];
        }

        return $output;
    }
}
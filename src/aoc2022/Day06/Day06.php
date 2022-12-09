<?php

declare(strict_types = 1);

namespace aoc2022\Day06;

final class Day06
{
    public function __construct(string $input)
    {
        $this->input = str_split($input);
    }

    public function task(int $markerLength): int
    {   
        $output = '';
        $marker = '';
        foreach ($this->input as $elem) {
            if (!str_contains($marker, $elem)) {
                if (strlen($marker) == $markerLength - 1) {
                    $marker = $marker . $elem;
                    $output = $output . $elem;
 
                    return strlen($output);
                }
                $marker .= $elem;
                $output .= $elem;
            } else {
                $output .= $elem;
                $marker = $this->findLastDifferent($marker, $elem);
            }
        }

        return 0;
    }

    private function findLastDifferent(string $marker, string $elem): string
    {  
        return substr($marker, strpos($marker, $elem) + 1) . $elem;
    }
}

<?php

declare(strict_types = 1);

namespace aoc2022\Day03;

final class Rucksack {

    private string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function commonElement(): string
    {
        $commonElement = array_intersect(
            str_split($this->firstCompartement()), 
            str_split($this->secondCompartement())
        );

        return array_values(array_unique($commonElement))[0];
    } 

    private function firstCompartement(): string
    {
        return substr($this->content,  0, strlen($this->content)/2);
    }

    private function secondCompartement(): string
    {
        return substr($this->content,  strlen($this->content)/2, strlen($this->content)/2);
    }
}

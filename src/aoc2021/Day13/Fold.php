<?php

declare(strict_types = 1);

namespace aoc2021\Day13;

final class Fold
{
    public string $axis;
    public int $value;

    public static function create(string $input): Fold
    {
        $fold = new self();
        $split = explode('=', $input);
        $fold->axis = $split[0];
        $fold->value = (int)$split[1];

        return $fold;
    }
}

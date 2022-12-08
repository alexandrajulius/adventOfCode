<?php

declare(strict_types = 1);

namespace aoc2022\Day05;

final class Order {

    private int $count;
    private int $from;
    private int $to;
    public function __construct(int $count, int $from, int $to)
    {
        $this->count = $count;
        $this->from = $from;
        $this->to = $to;
    }

    public function count(): int
    {
        return $this->count;
    }

    public function from(): int
    {
        return $this->from;
    }

    public function to(): int
    {
        return $this->to;
    }
}

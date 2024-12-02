<?php

declare(strict_types = 1);

namespace aoc2024\Day03;

final class Day03
{
    protected array $rawList = [];

    public function __construct(protected string $input)
    {
        $this->rawList = $this->toArray($input);
    }

    public function partOne(): int
    {
        return 0;
    }

    /**
     * @return string[]|bool
     */
    private function toArray(string $input): array
    {
        return explode(PHP_EOL, $input);
    }
}

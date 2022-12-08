<?php

declare(strict_types = 1);

namespace aoc2022\Day05;

final class Stack {

    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function initPush(string $item): void
    {
        array_unshift($this->items, $item);
    }

    public function push(string $item): void
    {
        $this->items[] = $item;
    }

    public function pushMultiple(array $items): void
    {
        foreach ($items as $item) {
            $this->push($item);
        }
    }

    public function pop(): string
    {
        return array_pop($this->items);
    }

    public function popMultiple(int $count): array
    {
        $cratesToMove = [];
        for ($i = 0; $i < $count; $i++) {
            $cratesToMove[] = array_pop($this->items);
        } 
        return array_reverse($cratesToMove);
    }

    // ha ha!
    public function top(): string
    {
        return end($this->items);
    }
}

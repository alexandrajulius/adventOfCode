<?php

declare(strict_types = 1);

namespace aoc2022\Day05;

final class Day05
{
    private const STACK_ELEM_LENGTH = 4;
    /** var Stack[] */
    private array $stacks;
    /** var Order[] */
    private array $orders;

    public function __construct(string $input)
    {
        $this->stacks = $this->createStacks($input);
        $this->orders = $this->createOrders($input);
    }

    public function firstTask(): string
    {   
        foreach ($this->orders as $order) {
            for ($i = 0; $i < $order->count(); $i++) {
                $topCrate = $this->stacks[$order->from()]->pop();
                $this->stacks[$order->to()]->push($topCrate);
            }
        }

        return $this->getWord();
    }

    public function secondTask(): string
    {   
        foreach ($this->orders as $order) {
            $topCrates = $this->stacks[$order->from()]->popMultiple($order->count());
            $this->stacks[$order->to()]->pushMultiple($topCrates);
        }

        return $this->getWord();
    }

    /*
            [D]    
        [N] [C]    
        [Z] [M] [P]
         1   2   3 
    */
    private function createStacks(string $input): array
    {
        $rawInput = explode("\n", $input);
        $rawCrateStacks = $this->getRawCrateStacks($rawInput);
        $stackCount = $this->getStackCount($rawCrateStacks);
        
        array_pop($rawCrateStacks);

        $stacks = [];
        for ($i = 0; $i < $stackCount; $i++) {
            $stacks[] =  new Stack([]);
        }

        foreach ($stacks as $stackKey => $stack) {
            foreach ($rawCrateStacks as $rawCrateLayer) {
                $stackElements = str_split($rawCrateLayer, self::STACK_ELEM_LENGTH);
                foreach ($stackElements as $elementKey => $element) {
                    if (str_contains($element, '[') && $elementKey === $stackKey) {
                        $stack->initPush($this->extractCrate($element));
                    }
                }
            }
        }

        return $stacks;
    }

    /* 
        move 1 from 2 to 1
        move 3 from 1 to 3
        move 2 from 2 to 1
        move 1 from 1 to 2
    */
    private function createOrders(string $input): array
    {
        $rawInput = explode("\n", $input);
        $rawOrders = [];
        foreach ($rawInput as $raw) {
            if (str_contains($raw, 'move')) {
                $rawOrders[] = $raw;
            }
        }

        $orders = [];
        foreach ($rawOrders as $rawOrder) {
            preg_match_all('!\d+!', $rawOrder, $order);    
            $orders[] = new Order((int)$order[0][0], (int)$order[0][1] - 1, (int)$order[0][2] - 1);
        }
        
        return $orders;
    }

    private function getRawCrateStacks(array $input): array
    {
        $temp = [];
        foreach ($input as $raw) {
            if (!str_contains($raw, 'move')) {
                $temp[] = $raw;
            }
        }
        array_pop($temp);

        return $temp;
    }

    private function getStackCount(array $rawCrateStacks): int
    {
        $rawStackCount = end($rawCrateStacks);

        return (int)substr(trim($rawStackCount), -1);
    }

    private function extractCrate(string $input): string
    {
        return substr($input, 1, 1);
    }

    private function getWord(): string
    {
        $word = '';
        foreach ($this->stacks as $stack) {
            $word .= $stack->top(); 
        }

        return $word;
    }
}

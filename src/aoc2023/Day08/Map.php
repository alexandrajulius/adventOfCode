<?php

declare(strict_types = 1);

namespace aoc2023\Day08;

class Map {

    public array $instructions = [];
    public array $nodes = [];

    public static function from(string $input): self
    {
        $map = new self();

        $map->instructions = self::getInstructions($input);
        $map->nodes = self::getNodes($input);
       
        return $map;
    }

    public function stepsPartOne(): int
    {   
        $departure = 'AAA';
        $arrival = 'ZZZ';
       
        $currentKey = $departure;
        $currentArrival = '';
        $stepCount = 0;
        while ($currentArrival !== $arrival):
            $currentNode = $this->getNode($currentKey);
            $instruction = $this->getCurrentInstruction($stepCount);
            $nextKey = $this->getNextNodeKey($currentNode, $instruction);
            $currentKey = $nextKey;
            $currentArrival = $nextKey;
            $stepCount++;
        endwhile;

        return $stepCount;
    }

    // foreach node a to node z path: find all steps separately
    // store those steps as int[]
    // the solution is to finnd the least common multiplier of this array of steps
    // the code works for the sample input but not for the actual one
    // it runs and runs and runs (maybe refactor Map->getNode())
    public function stepsPartTwo(): int
    {   
        $departures = $this->allNodeKeysEndingWith('A');
        $arrivals = $this->allNodeKeysEndingWith('Z');
        $steps = [];
        $currentArrival = '';
        $stepCount = 0;
        foreach ($departures as $index => $departure) {
            while ($currentArrival !== $arrivals[$index]):
                $currentNode = $this->getNode($departure);
                $instruction = $this->getCurrentInstruction($stepCount);
                $nextKey = $this->getNextNodeKey($currentNode, $instruction);
                $departure = $nextKey;
                $currentArrival = $nextKey;
                $stepCount++;
                if ($currentArrival === $arrivals[$index]) {
                    $steps[] = $stepCount;
                    $stepCount = 0;
                }
            endwhile;
        }

        return $this->findlcm($steps, count($steps));
    }
    
    private function findlcm(array $arr, int $n): int
    {
        $ans = $arr[0];
        for ($i = 1; $i < $n; $i++)
            $ans = ((($arr[$i] * $ans)) /
                    ($this->gcd($arr[$i], $ans)));
    
        return $ans;
    }

    private function gcd(int $a, int $b): int
    {
        if ($b == 0)
            return $a;
        return $this->gcd($b, $a % $b);
    }

    private function allNodeKeysEndingWith(string $char): array
    {
        $nodes = [];
        foreach ($this->nodes as $node) {
            if (substr($node->key, -1) === $char) {
                $nodes[] = $node->key;
            }
        }

        return $nodes;
    }

    private function getCurrentInstruction(int $stepCount): string
    {           
        return $this->instructions[$stepCount % count($this->instructions)];
    }

    private function getNode(string $key): ?MapNode
    {
        // oh god
        foreach ($this->nodes as $node) {
            if ($node->key === $key) {
                return $node;
            }
        }

        return null;
    }

    private function getNextNodeKey(MapNode $node, string $instruction): string
    {   
        return $instruction === 'R' ? $node->right : $node->left;
    }

    private static function getInstructions(string $input): array
    {
        $raw = self::split($input);
       
        return str_split($raw[0]);
    }

    private static function getNodes($input): array
    {
        $raw = self::split($input);
        $rawInstructions = array_map('trim', explode(PHP_EOL, $raw[1]));
        $nodes = [];
        foreach ($rawInstructions as $raw) {
            $nodes[] = MapNode::from($raw);
        }

        return $nodes;
    }

    private static function split(string $input): array
    {
        return array_map('trim', preg_split("#\n\s*\n#Uis", $input));
    }
}
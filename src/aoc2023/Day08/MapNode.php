<?php

declare(strict_types = 1);

namespace aoc2023\Day08;

final class MapNode {

    public string $original = '';
    public string $key = '';
    public string $left = '';
    public string $right = '';

    public static function from(string $input): self
    {
        $node = new self();
        $node->original = $input;
        $node->key = self::getKey($input);
        $values = self::getValues($input);
        $node->left = $values[0];
        $node->right = $values[1];
        
        return $node;
    }

    private static function getKey(string $input): string
    {
        return trim(strtok($input, '='));
    }

    private static function getValues(string $input): array
    {
        $raw = trim(substr($input, strpos($input, '=') + 2));
        $rawTidy = str_replace(['(', ')'], '', $raw);

        return array_map('trim', explode(',', $rawTidy));
    }
}
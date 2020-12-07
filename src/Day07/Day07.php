<?php

declare(strict_types=1);

namespace Day07;

final class Day07
{
    // Bag procession
    public function getAmountOfContainedBags(string $rawInput, array $bag): int
    {
        $allRules = $this->convertInput($rawInput);

        $results = $this->traverseRulesToGetContainedBags($allRules, $bag, []);

        $products = [];
        foreach ($results as $result) {
            $products[] = array_product($result['resultCount']);
        }

        return array_sum($products);
    }

    public function traverseRulesToGetContainedBags(array $allRules, array $bag, array $stack): array
    {
        $resultBags = [];
        array_push($stack, $bag['count']);

        foreach ($allRules as $leftSide => $rightSides) {
            if ($leftSide === $bag['bag']) {
                foreach ($rightSides as $rightSide) {
                    if ($rightSide !== 'no other') {
                        $tempResultBag = [
                            'count' => (int)substr($rightSide, 0, 1),
                            'bag' => substr($rightSide, 2),
                            'resultCount' => $stack,
                        ];
                        array_push($tempResultBag['resultCount'], (int)substr($rightSide, 0, 1));
                        $resultBags[] = $tempResultBag;
                        $nextTraversalResults = $this->traverseRulesToGetContainedBags($allRules, $tempResultBag, $stack);

                        foreach ($nextTraversalResults as $tempResult) {
                            array_push($tempResultBag['resultCount'], $tempResult['count']);
                            $resultBags[] = $tempResult;
                        }
                    }
                }
            }
        }

        return $resultBags;
    }

    public function getAmountOfContainingBags(string $rawInput, string $bag): int
    {
        $allRules = $this->convertInput($rawInput);

        $result = $this->traverseRulesToGetContainingBags($allRules, $bag);

        return count($result);
    }

    private function convertInput(string $rawInput): array
    {
        $rawRules = explode(".\n", $rawInput);
        $rules = [];
        foreach ($rawRules as $rule) {
            $rules[] = explode(' bags contain ', $rule);
        }

        $sanitizedRules = [];
        foreach ($rules as $key => $value) {
            $sanitizedRightSide = str_replace([' bags', ' bag', '.'], '', $value[1]);
            $rightSide = explode(', ', $sanitizedRightSide);
            $sanitizedRules[$value[0]] = $rightSide;
        }

        return $sanitizedRules;
    }

    public function traverseRulesToGetContainingBags(array $allRules, string $bag): array
    {
        $resultBags = [];
        foreach ($allRules as $leftSide => $rightSides) {
            foreach ($rightSides as $rightSide) {
                if (strpos($rightSide, $bag) !== false) {
                    $resultBags[] = $leftSide;
                    $nextTraversalResults = $this->traverseRulesToGetContainingBags($allRules, $leftSide);
                    if ($nextTraversalResults !== []) {
                        foreach ($nextTraversalResults as $tempResult) {
                            $resultBags[] = $tempResult;
                        }
                    }
                }
            }
        }

        return array_unique($resultBags);
    }
}
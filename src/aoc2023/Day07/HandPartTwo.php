<?php

declare(strict_types = 1);

namespace aoc2023\Day07;

final class HandPartTwo extends Hand {

    public array $valueCountMapWithoutJ = [];
    public int $jokerCount = 0;

    /**
     * @param string[]
     */
    public static function from(array $rawCardsAndBids): self
    {
        $hand = new self();
        $hand->original = $rawCardsAndBids[0];
        $cardLabels = str_split($rawCardsAndBids[0]);
        foreach ($cardLabels as $rawCard) {
            $hand->cardValues[] = (new CardPartTwo($rawCard))->value();
        }
        $hand->bid = intval($rawCardsAndBids[1]);
        $hand->valueCountMap = array_count_values($hand->cardValues);
        $hand->jokerCount = isset($hand->valueCountMap[1]) ? $hand->valueCountMap[1] : 0;
        $hand->valueCountMapWithoutJ = $hand->valueCountMap;
        unset($hand->valueCountMapWithoutJ[1]);
        self::determineTypeWithJoker($hand);
   
        return $hand;
    }

    public static function determineTypeWithJoker(Hand $hand): void
    {
        switch ($hand->jokerCount) {
            case 5:
                self::setTypeAndStrength($hand, self::FIVE_OF_A_KIND);
            case 4:
                self::setTypeAndStrength($hand, self::FIVE_OF_A_KIND);
            case 3:
                if (count($hand->valueCountMapWithoutJ) === 1) {   
                    self::setTypeAndStrength($hand, self::FIVE_OF_A_KIND);
                }
                if (count($hand->valueCountMapWithoutJ) === 2) {   
                    self::setTypeAndStrength($hand, self::FOUR_OF_A_KIND);
                }
            case 2:
                if (count($hand->valueCountMapWithoutJ) === 1) {   
                    self::setTypeAndStrength($hand, self::FIVE_OF_A_KIND);
                }
                if (count($hand->valueCountMapWithoutJ) === 2) {   
                    self::setTypeAndStrength($hand, self::FOUR_OF_A_KIND);
                }
                if (count($hand->valueCountMapWithoutJ) === 3) {   
                    self::setTypeAndStrength($hand, self::THREE_OF_A_KIND);
                } 
            case 1:
                if (count($hand->valueCountMapWithoutJ) === 1) {
                    self::setTypeAndStrength($hand, self::FIVE_OF_A_KIND);
                } 
                if (count($hand->valueCountMapWithoutJ) === 2) {
                    if ($hand->valueCountMapWithoutJ[array_key_first($hand->valueCountMapWithoutJ)] === $hand->valueCountMapWithoutJ[array_key_last($hand->valueCountMapWithoutJ)]) {
                        self::setTypeAndStrength($hand, self::FULL_HOUSE);
                    } else {
                        self::setTypeAndStrength($hand, self::FOUR_OF_A_KIND);
                    } 
                }
                if (count($hand->valueCountMapWithoutJ) === 3) {
                    self::setTypeAndStrength($hand, self::THREE_OF_A_KIND);
                } 
                if (count($hand->valueCountMapWithoutJ) === 4) {
                    self::setTypeAndStrength($hand, self::ONE_PAIR);
                }
            case 0:
                self::determineType($hand);
        }
    }
}
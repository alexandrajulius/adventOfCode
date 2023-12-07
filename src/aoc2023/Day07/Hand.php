<?php

declare(strict_types = 1);

namespace aoc2023\Day07;

class Hand {

    public const FIVE_OF_A_KIND = 'Five of a kind';
    public const FOUR_OF_A_KIND = 'Four of a kind';
    public const FULL_HOUSE = 'Full House';
    public const THREE_OF_A_KIND = 'Three of a kind';
    public const TWO_PAIR = 'Two pair';
    public const ONE_PAIR = 'One pair';
    public const HIGH_CARD = 'High Card';

    public const STRENGTH = [
        Hand::HIGH_CARD,
        Hand::ONE_PAIR,
        Hand::TWO_PAIR,
        Hand::THREE_OF_A_KIND,
        Hand::FULL_HOUSE,
        Hand::FOUR_OF_A_KIND,
        Hand::FIVE_OF_A_KIND
    ];

    public string $original = '';
    public array $cardValues = [];
    public array $valueCountMap = [];
    public int $bid = 0;
    public string $type = '';
    public int $strength = 0;

    /**
     * @param string[]
     */
    public static function from(array $rawCardsAndBids): self
    {
        $hand = new self();
        $hand->original = $rawCardsAndBids[0];
        $cardLabels = str_split($rawCardsAndBids[0]);
        foreach ($cardLabels as $rawCard) {
            $hand->cardValues[] = (new Card($rawCard))->value();
        }
        $hand->bid = intval($rawCardsAndBids[1]);
        $hand->valueCountMap = array_count_values($hand->cardValues);
        self::determineType($hand);
        
        return $hand;
    }

    protected static function determineType(Hand $hand): void
    {
        if (self::isFiveOfAKind($hand)) {
            self::setTypeAndStrength($hand, self::FIVE_OF_A_KIND);
        }

        if (self::isFourOfAKind($hand)) {
            self::setTypeAndStrength($hand, self::FOUR_OF_A_KIND);
        }
        
        if (self::isFullHouse($hand)) {
            self::setTypeAndStrength($hand, self::FULL_HOUSE);
        }

        if (self::isThreeOfAKind($hand)) {
            self::setTypeAndStrength($hand, self::THREE_OF_A_KIND);
        }

        if (self::isTwoPair($hand)) {
            self::setTypeAndStrength($hand, self::TWO_PAIR);
        }

        if (self::isOnePair($hand)) {
            self::setTypeAndStrength($hand, self::ONE_PAIR);
        }

        if (self::isHighCard($hand)) {
            self::setTypeAndStrength($hand, self::HIGH_CARD);
        }
    }

    private static function isFiveOfAKind(Hand $hand): bool
    {
        return count($hand->valueCountMap) === 1;
    }

    private static function isFourOfAKind(Hand $hand): bool
    {
        return in_array(4, $hand->valueCountMap);
    }

    private static function isThreeOfAKind(Hand $hand): bool
    {
        return in_array(3, $hand->valueCountMap);
    }

    private static function isTwoPair(Hand $hand): bool
    {
        return self::getPairCount($hand) === 2;
    }

    private static function isOnePair(Hand $hand): bool
    {
        return self::getPairCount($hand) === 1;
    }

    private static function isHighCard(Hand $hand): bool
    {
        return count($hand->valueCountMap) === 5;
    }

    private static function isFullHouse(Hand $hand): bool
    {
        return in_array(2, $hand->valueCountMap) && in_array(3, $hand->valueCountMap);
    }

    private static function getPairCount(Hand $hand): int
    {
        $inc = 0;
        foreach ($hand->valueCountMap as $count) {
            if ($count === 2) {
                $inc++;
            }
        }
        return $inc;
    }

    protected static function setTypeAndStrength(Hand $hand, string $type): void
    {
        if ($hand->type === '' && $hand->strength === 0) {
            $hand->type = $type;
            $hand->strength = array_search($type, self::STRENGTH) + 1;
        }
    }

}
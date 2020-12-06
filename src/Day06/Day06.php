<?php

declare(strict_types=1);

namespace Day06;

final class Day06
{
    public function getAmountOfCommonAnswers(string $rawInput): int
    {
        $allGroupsAnswers = $this->convertInput($rawInput);
        $allUniqueYesAnswers = [];
        foreach ($allGroupsAnswers as $groupsAnswers) {
            $allUniqueYesAnswers[] = $this->getAmountOfCommonYesAnswersPerGroup($groupsAnswers);
        }

        return array_sum($allUniqueYesAnswers);
    }

    public function getAmountOfAnswers(string $rawInput): int
    {
        $allGroupsAnswers = $this->convertInput($rawInput);
        $allYesAnswers = [];
        foreach ($allGroupsAnswers as $groupsAnswers) {
            $allYesAnswers[] = $this->getAmountOfYesAnswersPerGroup($groupsAnswers);
        }

        return array_sum($allYesAnswers);
    }

    private function convertInput(string $rawInput): array
    {
        $allGroupsAnswers = explode("\n\n", $rawInput);

        $output = [];
        foreach ($allGroupsAnswers as $answersPerGroup) {
            $output[] = explode("\n", $answersPerGroup);
        }

        return $output;
    }

    private function getAmountOfYesAnswersPerGroup(array $answersPerGroup): int
    {
        $flattenedGroupAnswers = '';
        foreach ($answersPerGroup as $answersPerPerson) {
            $flattenedGroupAnswers .= $answersPerPerson;
        }

        $unique = array_unique(str_split($flattenedGroupAnswers));
        $amount = array_count_values($unique);

        return array_sum($amount);
    }

    public function getAmountOfCommonYesAnswersPerGroup(array $answersPerGroup): int
    {
        $answersPerPersonArray = [];
        foreach ($answersPerGroup as $answersPerPersonString) {
            $answersPerPersonArray[] = str_split($answersPerPersonString);
        }

        if (count($answersPerPersonArray) == 1) {
            return count($answersPerPersonArray[0]);
        }

        $result = array_intersect(...$answersPerPersonArray);

        return count($result);
    }
}
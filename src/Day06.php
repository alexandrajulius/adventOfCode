<?php

declare(strict_types=1);

final class Day06
{
    public function getAnswersPerGroup(string $rawInput): int
    {
        $allGroupsAnswers = $this->convertInputData($rawInput);

        return array_sum($allGroupsAnswers);
    }

    private function convertInputData(string $rawInput): array
    {
        $allGroupsAnswers = explode("\n\n", $rawInput);

        $output = [];
        foreach ($allGroupsAnswers as $answersPerGroup) {
            $output[] = $this->getAmountOfYesAnswers(explode("\n", $answersPerGroup));
        }

        return $output;
    }

    public function getAmountOfYesAnswers(array $answersPerGroup): int
    {
        $flattenedGroupAnswers = '';
        foreach ($answersPerGroup as $answers) {
            $flattenedGroupAnswers .= $answers;
        }

        $unique = array_unique(str_split($flattenedGroupAnswers));
        $amount = array_count_values($unique);

        return array_sum($amount);
    }
}
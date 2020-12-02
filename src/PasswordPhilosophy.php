<?php

declare(strict_types=1);

final class PasswordPhilosophy
{
    public function getAmountOfValidPasswords(array $passwordList): int
    {
        $count = 0;
        foreach ($passwordList as $password) {
            if ($this->isValidPasswordConsideringPosition($password)) {
                $count++;
            }
        }

        return $count;
    }

    public function isValidPasswordConsideringPosition(string $ruleAndPassword): bool
    {
        [$rule, $password] = $this->extractRuleAndPassword($ruleAndPassword);
        [$min, $max, $seedLetter] = $this->extractMinMaxSeed($rule);

        $passwordArray = str_split($password);

        if (!in_array($seedLetter, $passwordArray)) {
            return false;
        }

        if (count($passwordArray) < ($max - 1)) {
            return false;
        }

        if (!(($passwordArray[$min - 1] == $seedLetter) xor ($passwordArray[$max - 1] == $seedLetter))) {
            return false;
        }

        return true;
    }

    public function isValidPassword(string $ruleAndPassword): bool
    {
        [$rule, $password] = $this->extractRuleAndPassword($ruleAndPassword);
        [$min, $max, $seedLetter] = $this->extractMinMaxSeed($rule);

        $passwordArray = str_split($password);

        $counts = array_count_values($passwordArray);

        if (!in_array($seedLetter, $passwordArray)) {
            return false;
        }

        if (($counts[$seedLetter] < $min) || ($counts[$seedLetter] > $max)) {
            return false;
        }

        return true;
    }

    private function extractRuleAndPassword(string $ruleAndPassword): array
    {
        $array = explode(': ', $ruleAndPassword);

        return $array;
    }

    private function extractMinMaxSeed(string $rule): array
    {
        $extractMin = explode('-', $rule);
        $min = (int)$extractMin[0];
        $extractMax = explode(' ', $extractMin[1]);
        $max = (int)$extractMax[0];
        $seedLetter = $extractMax[1];

        return [$min, $max, $seedLetter];
    }
}
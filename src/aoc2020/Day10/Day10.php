<?php

declare(strict_types=1);

namespace aoc2020\Day10;

final class Day10
{
    public array $diffs = [];
    public int $currentRating = 0;
    public int $validArrangementsCount = 1;

    public function firstTask(string $input): int
    {
        $adapterRatings = $this->toArray($input);
        foreach ($adapterRatings as $adapterRating) {
            $diff = $adapterRating - $this->currentRating;
            if ($diff <= 3 ) {
                $this->update($diff, $adapterRating);
            }
        }

        return $this->diffs[1] * $this->diffs[3];
    }

    private function toArray(string $input): array
    {
        $raw = array_map('intval', explode(PHP_EOL, $input));
        $raw[] = 0;
        asort($raw);
        $peter = array_values($raw);
        $peter[] = $peter[count($peter) - 1] + 3;

        return $peter;
    }

    private function update(int $diff, int $adapterRating): void
    {
        if (!isset($this->diffs[$diff])) {
            $this->diffs[$diff] = 1;
            $this->currentRating = $adapterRating;
        } else {
            $this->diffs[$diff] += 1;
            $this->currentRating = $adapterRating;
        }
    }
}

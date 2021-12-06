<?php

declare(strict_types = 1);

namespace aoc2021\Day06;

final class Day06
{
    public function firstTask(string $input, int $days): int
    {
        $timerList = $this->getTimerList($input);
        while ($days >= 1) {
            foreach ($timerList as $timer) {
                if ($timer->value >= 0) {
                    $timer->decrease();
                }

                if ($timer->value === -1) {
                    $timer->reset();
                    $timerList[] = new Timer(8);
                }

            }
            $days--;
        }

        return count($timerList);
    }

    /**
     * @return Timer[]
     */
    private function getTimerList(string $input): array
    {
        $stringList = explode(',', $input);
        $timerList = [];
        foreach ($stringList as $timer) {
            $timerList[] = new Timer((int)$timer);
        }
        return $timerList;
    }
}

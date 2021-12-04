<?php

declare(strict_types = 1);

namespace Tennis;

interface TennisGame
{
    /**
     * @param  $playerName
     * @return void
     */
    public function wonPoint($playerName);

    /**
     * @return string
     */
    public function getScore();
}

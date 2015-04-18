<?php namespace Cryptic\Wgrpg\Lib\Domain\Constants\Tile;

final class State
{
    const CLOSED = -2;
    const LOCKED = -1;
    const NONE = 0;
    const UNLOCKED = 1;
    const OPEN = 2;

    private function __construct()
    {
        //
    }
}

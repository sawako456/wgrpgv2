<?php namespace Cryptic\Wgrpg\Lib\Domain\Constants\Map;

final class Type
{
    const RANDOM_MOUNTAINS = -7;
    const RANDOM_CAVES = -6;
    const RANDOM_CITY = -5;
    const RANDOM_TOWN = -4;
    const RANDOM_VILLAGE = -3;
    const RANDOM_DUNGEON = -2;
    const RANDOM_PLAINS = -1;
    const NONE = 0;
    const PLAINS = 1;
    const DUNGEON = 2;
    const VILLAGE = 3;
    const TOWN = 4;
    const CITY = 5;
    const CAVES = 6;
    const MOUNTAINS = 7;

    private function __construct()
    {
        //
    }
}

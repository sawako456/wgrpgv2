<?php

use Cryptic\Wgrpg\Lib\Domain\Constants\Map\Type as MapType;
use Cryptic\Wgrpg\Lib\Domain\Constants\Tile\State as TileState;
use Cryptic\Wgrpg\Lib\Domain\Constants\Tile\Type as TileType;
use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maps')->delete();
        DB::table('tiles')->delete();

        $maps = App::make('Cryptic\Wgrpg\Contracts\Repositories\Map\Repository');
        $worlds = App::make('Cryptic\Wgrpg\Contracts\Repositories\World\Repository');
        $tiles = App::make('Cryptic\Wgrpg\Contracts\Repositories\Tile\Repository');

        foreach ($worlds->all() as $world) {
            $map = [
                'name' => 'default_map',
                'text_entry' => 'maps.dungeon.description',
                'type' => MapType::DUNGEON,
                'world_id' => $world->id,
            ];

            $map = $maps->create($map);

            for ($row = 2; $row > -2; --$row) {
                for ($col = -2; $col < 2; ++$col) {
                    $type = TileType::DUNGEON;
                    $textEntry = 'tiles.dungeon.description';

                    if (in_array($row, [2, -1]) || in_array($col, [-2, 1])) {
                        $type = TileType::DUNGEON_WALL;
                        $textEntry = 'tiles.dungeon.wall.description';
                    }

                    $tile = [
                        'x' => $col,
                        'y' => 0, // Default is 0
                        'z' => $row,
                        'text_entry' => $textEntry,
                        'type' => $type,
                        'state' => TileState::NONE,
                        'map_id' => $map->id,
                    ];

                    $tiles->create($tile);
                }
            }
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class WorldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('worlds')->delete();

        $worlds = App::make('Cryptic\Wgrpg\Contracts\Repositories\World\Repository');
        $users = App::make('Cryptic\Wgrpg\Contracts\Repositories\User\Repository');

        foreach ($users->all() as $user) {
            $world = [
                'name' => $user->username . '_world',
                'seed' => str_random(32),
                'time' => 0, // 0 is default
                'user_id' => $user->id,
            ];

            $worlds->create($world);
        }
    }
}

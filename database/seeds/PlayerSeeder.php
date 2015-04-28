<?php

use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = App::make('Cryptic\Wgrpg\Contracts\Repositories\Role\Repository');
        $users = App::make('Cryptic\Wgrpg\Contracts\Repositories\User\Repository');
        $hash = App::make('Illuminate\Contracts\Hashing\Hasher');

        $playerRoles = $roles->getWhereIn('name', ['Login', 'Player'])->lists('id');
        $names = [
            'superman01',
            'krueger',
            'johnnyman',
            'tomten',
            'haxxmaster',
            'skummis',
            'snigelkott',
            'mrpackman',
            '4greatjustice',
            'buzzsoundyear',
            'thepunisher',
            'infinitemass',
            'destroyed',
            'slugger',
            'feeder',
            'feedee',
            'immobile',
            'stuffed',
            'forcefed',
        ];

        for ($i = 0; $i < count($names); ++$i) {
            $email = 'dev+' . $names[$i] . '@wgrpg.soud.se';

            $player = $users->create([
                'username' => $names[$i],
                'email' => $email,
                'password' => $hash->make($names[$i]),
            ]);

            $player->roles()->sync($playerRoles);
        }
    }
}

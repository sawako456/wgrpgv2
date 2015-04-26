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
            'Freddie Mercury',
            'サイタマ',
            'Abraham Lincoln',
            'Max Payne',
            'James Bond',
            '川神 百代',
            '直江 大和',
            '椎名 京',
            '黛 由紀江',
            '川神 一子',
            'クリスティアーネ・フリードリヒ',
            'Bee Bop',
            'Rock Steady',
            'Master Splinter',
            'Shredder',
            'Krang',
            'Kraid',
            'Mother Brain',
            'Samus Aran',
            'Ridley',
            'Meta Knight',
            'Kirby',
            'Östen',
            'Sarah Connor',
            'The Governator',
            'Austin Powers',
            'Jimmie Rustler',
        ];

        for ($i = 0; $i < count($names); ++$i) {
            $email = 'dev+player.' . ($i + 1) . '@wgrpg.soud.se';

            $player = $users->create([
                'username' => $names[$i],
                'email' => $email,
                'password' => $hash->make($email),
            ]);

            $player->roles()->sync($playerRoles);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('users')->delete();

        $users = App::make('Cryptic\Wgrpg\Contracts\Repositories\User\Repository');
        $roles = App::make('Cryptic\Wgrpg\Contracts\Repositories\Role\Repository');
        $createAdmin = (bool) env('ROOT_USER_USERNAME', false);

        $roleData = [
            ['name' => 'Login'],
            ['name' => 'Player'],
            ['name' => 'Admin'],
        ];

        foreach ($roleData as $role) {
            $roles->create($role);
        }

        if ($createAdmin) {
            $username = env('ROOT_USER_USERNAME');
            $email = env('ROOT_USER_EMAIL');
            $password = Hash::make(env('ROOT_USER_PASSWORD'));

            $root = $users->create(compact('username', 'email', 'password'));

            $adminRoles = $roles->getWhereIn('name', ['Login', 'Admin'])->lists('id');

            $root->roles()->sync($adminRoles);
        }
    }
}

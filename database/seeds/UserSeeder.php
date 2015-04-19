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

        $roles = App::make('Cryptic\Wgrpg\Contracts\Repositories\Role\Repository');
        $users = App::make('Cryptic\Wgrpg\Contracts\Repositories\User\Repository');

        $roleData = [
            ['name' => 'Login'],
            ['name' => 'Player'],
            ['name' => 'Admin'],
        ];

        foreach ($roleData as $role) {
            $roles->create($role);
        }

        $admins = [];
        $adminRoles = $roles->getWhereIn('name', ['Login', 'Admin'])->lists('id');

        if (env('ADMIN_USER_1_USERNAME')) {
            $username = env('ADMIN_USER_1_USERNAME');
            $email = env('ADMIN_USER_1_EMAIL');
            $password = Hash::make(env('ADMIN_USER_1_PASSWORD'));
            $admin1 = $users->create(compact('username', 'email', 'password'));
            $admins[] = $admin1;
        }

        if (env('ADMIN_USER_2_USERNAME')) {
            $username = env('ADMIN_USER_2_USERNAME');
            $email = env('ADMIN_USER_2_EMAIL');
            $password = Hash::make(env('ADMIN_USER_2_PASSWORD'));
            $admin2 = $users->create(compact('username', 'email', 'password'));
            $admins[] = $admin2;
        }

        if (env('ADMIN_USER_3_USERNAME')) {
            $username = env('ADMIN_USER_3_USERNAME');
            $email = env('ADMIN_USER_3_EMAIL');
            $password = Hash::make(env('ADMIN_USER_3_PASSWORD'));
            $admin3 = $users->create(compact('username', 'email', 'password'));
            $admins[] = $admin3;
        }

        foreach ($admins as $admin) {
            $admin->roles()->sync($adminRoles);
        }
    }
}

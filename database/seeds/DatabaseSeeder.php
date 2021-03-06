<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserSeeder');
        $this->call('PlayerSeeder');
        $this->call('WorldSeeder');
        $this->call('MapSeeder');
        // $this->call('EventSeeder');
    }
}

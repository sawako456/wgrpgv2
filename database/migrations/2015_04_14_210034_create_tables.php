<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('username')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password', 60);
            $table->integer('logins')->default(0);
            $table->timestamp('last_login_at');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

        Schema::create('worlds', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('seed');
            $table->integer('user_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('maps', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('xml_file_name')->nullable();
            $table->integer('x_coord');
            $table->integer('y_coord');
            $table->integer('z_coord');
            $table->integer('world_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('world_id')->references('id')->on('worlds')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('height')->unsigned(); // use centimeters
            $table->integer('weight')->unsigned(); // use grams
            // max weight in lbs: (4294967295 / 1000) * 2.20462 = ~9468770
            $table->integer('digestion_rate')->unsigned();
            $table->integer('armour_rip_level')->unsigned();
            // TODO: Better solution/names for character coordinates?
            $table->integer('x_coord');
            // $table->integer('y_coord'); // Use this?
            $table->integer('z_coord');
            $table->integer('user_id')->unsigned();
            $table->integer('map_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
             $table->foreign('map_id')->references('id')->on('maps')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('xml_file_name');
            $table->boolean('repeating')->default(false);
            $table->integer('map_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('map_id')->references('id')->on('maps')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('items', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('type')->unsigned()->default(1); // TODO: Come up with something that works, don't wanna join stuff here. Enums maybe?
            $table->integer('calories')->unsigned()->nullable();
            $table->integer('damage')->unsigned()->nullable();
            $table->integer('defence')->unsigned()->nullable();
            $table->string('size')->nullable();
            $table->integer('event_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('event_id')->references('id')->on('events')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
        Schema::dropIfExists('events');
        Schema::dropIfExists('characters');
        Schema::dropIfExists('maps');
        Schema::dropIfExists('worlds');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
    }

}

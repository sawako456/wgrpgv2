<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTables extends Migration
{
    /*
    |-----------------------------------------------------------------------
    | Notes
    |-----------------------------------------------------------------------
    |
    | Integer sizes:
    |   tinyInteger  - 1 byte (8 bit, -128 to 127 signed)
    |   smallInteger - 2 byte (16 bit, -32768 to 32767 signed, C int)
    |   integer      - 4 byte (32 bit, -2147483648 to 2147483647 signed, C long, php int)
    |
    |
    */

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        |-----------------------------------------------------------------------
        | Site / User tables
        |-----------------------------------------------------------------------
        */

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('username')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password', 60);
            $table->integer('logins')->default(0);
            $table->datetime('last_login_at')->nullable();
            $table->string('time_zone')->default('UTC');

            $table->rememberToken();

            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->datetime('deleted_at')->nullable();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->string('label');

            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->datetime('deleted_at')->nullable();
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

            $table->datetime('created_at');
        });

        /*
        |-----------------------------------------------------------------------
        | Global tables
        |-----------------------------------------------------------------------
        */

        Schema::create('conditions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            /*
             * See link for suggestions on types:
             *   http://docs.getmangos.com/en/latest/database/world/conditions.html
             */
            $table->tinyInteger('type');
            $table->integer('value1'); // TODO: Figure out if we should index these cols
            $table->integer('value2');
        });

        /*
        |-----------------------------------------------------------------------
        | World and event tables
        |-----------------------------------------------------------------------
        */

        Schema::create('worlds', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('seed');
            $table->integer('time')->unsigned()->default(0); // seconds?
            $table->integer('user_id')->unsigned();

            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->datetime('deleted_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('maps', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('text_entry')->nullable();
            /*
             * Event types:
             *   \Cryptic\Wgrpg\Lib\Domain\Constants\Map\Type
             */
            $table->tinyInteger('type')->default(0);
            $table->integer('world_id')->unsigned();

            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->datetime('deleted_at')->nullable();

            $table->foreign('world_id')->references('id')->on('worlds')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('tiles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('x');
            $table->integer('y')->default(0);
            $table->integer('z');
            $table->string('text_entry')->nullable();
            /*
             * Tile types:
             *   \Cryptic\Wgrpg\Lib\Domain\Constants\Tile\Type
             */
            $table->tinyInteger('type')->default(0);
            /*
             * Tile types:
             *   \Cryptic\Wgrpg\Lib\Domain\Constants\Tile\State
             */
            $table->tinyInteger('state')->default(0);
            $table->integer('map_id')->unsigned();

            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->datetime('deleted_at')->nullable();

            $table->foreign('map_id')->references('id')->on('maps')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            /*
             * Event types:
             *   \Cryptic\Wgrpg\Lib\Domain\Constants\Event\Type
             */
            $table->tinyInteger('type')->default(0);
            $table->integer('condition_id_1')->unsigned()->nullable();
            $table->integer('condition_id_2')->unsigned()->nullable();
            $table->integer('condition_id_3')->unsigned()->nullable();
            $table->tinyInteger('trigger_chance')->unsigned()->default(0);
            $table->integer('trigger_value_1')->nullable();
            $table->integer('trigger_value_2')->nullable();
            $table->integer('trigger_value_3')->nullable();

            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->datetime('deleted_at')->nullable();
        });

        /*
        |-----------------------------------------------------------------------
        | Character / NPC / Creature tables
        |-----------------------------------------------------------------------
        */

        // Schema::create('units', function (Blueprint $table) {
        //     $table->increments('id')->unsigned();
        //     $table->string('name');
        //     /**
        //      * Races:
        //      *     1 - Human
        //      */
        //     $table->tinyInteger('race')->default(1);
        //     /**
        //      * Genders:
        //      *     1 - Female
        //      *     2 - Male
        //      */
        //     $table->tinyInteger('gender')->default(1);
        //     /**
        //      * Sexual orientations:
        //      *     1 - Heterosexual
        //      *     2 - Homosexual
        //      *     3 - Bisexual
        //      *     4 - Asexual
        //      */
        //     $table->tinyInteger('orientation')->default(1);
        //     /**
        //      * Personality types:
        //      *     1 - Shy
        //      *     2 - Outgoing
        //      *     3 - Stoic
        //      */
        //     $table->tinyInteger('personality')->default(1);
        //     /**
        //      * Attitudes against fat:
        //      *     1 - Negative
        //      *     2 - Neutral
        //      *     3 - Positive
        //      */
        //     $table->tinyInteger('fat_stance')->default(1);
        //     /**
        //      * Eye colours:
        //      *     1 - Brown
        //      *     2 - Blue
        //      *     3 - Green
        //      *     4 - Black
        //      *     5 - Red
        //      *     6 - White
        //      *     7 - Grey
        //      */
        //     $table->tinyInteger('eye_colour')->default(1);
        //     /**
        //      * Hair colours:
        //      *     1 - Brown
        //      *     2 - Blonde
        //      *     3 - Black
        //      *     4 - Red
        //      *     5 - Brunette
        //      *     6 - White
        //      *     7 - Orange
        //      *     8 - Green
        //      *     9 - Blue
        //      *     10 - Pink
        //      *     11 - Yellow
        //      *     12 - Purple
        //      */
        //     $table->tinyInteger('hair_colour')->default(1);
        //     /**
        //      * Hair lengths:
        //      *     0 - Bald?
        //      *     1 - Short
        //      *     2 - Medium
        //      *     3 - Shoulder length
        //      *     4 - Long
        //      */
        //     $table->tinyInteger('hair_length')->default(1);
        //     /**
        //      * Ethnicities:
        //      *     1 - White
        //      *     2 - Peach
        //      *     3 - Tan
        //      *     4 - Brown
        //      *     5 - Black
        //      *     6 - Olive
        //      */
        //     $table->tinyInteger('ethnicity')->default(1);
        //     $table->tinyInteger('level')->default(1); // Max level 127 too low?
        //     $table->integer('health')->unsigned()->default(1);
        //     $table->integer('experience')->default(0); // TODO: Create formula to calc needed to next level
        //     $table->integer('stat_points')->default(0);
        //     $table->integer('copper')->default(0); // 1 gold = 100 silver = 1000 copper?
        //     $table->integer('strength')->default(0);
        //     $table->integer('intelligence')->default(0);
        //     $table->integer('agility')->default(0);
        //     $table->integer('vitality')->default(0);
        //     // max weight in lbs: 4.294.967.295
        //     $table->integer('height')->unsigned()->default(165); // cm
        //     $table->integer('weight')->unsigned()->default(100); // lbs
        //     $table->integer('digestion_rate')->unsigned()->default(250);
        //     // TODO: Better solution/names for character coordinates?
        //     $table->integer('x_coord')->default(0);
        //     // $table->integer('y_coord')->default(0); // Use this?
        //     $table->integer('z_coord')->default(0);
        //     $table->integer('map_id')->unsigned();
        //     $table->integer('user_id')->unsigned()->nullable();

        //     $table->timestamps();
        //     $table->softDeletes();

        //     $table->foreign('map_id')->references('id')->on('maps')
        //         ->onUpdate('cascade')
        //         ->onDelete('cascade');
        //     $table->foreign('user_id')->references('id')->on('users')
        //         ->onUpdate('cascade')
        //         ->onDelete('cascade');
        // });

        // Schema::create('item_templates', function (Blueprint $table) {
        //     $table->increments('id')->unsigned();
        //     $table->string('name');
        //     $table->text('description')->nullable();
        //     /**
        //      * Item types:
        //      *     1 - Weapon:Blunt
        //      *     2 - Weapon:Sword
        //      *     3 - Weapon:Axe
        //      *     4 - Weapon:Sword And Shield
        //      *     5 - Weapon:Staff
        //      *     6 - Weapon:Tome
        //      *     7 - Weapon:Wand
        //      *     8 - Weapon:Dagger
        //      *     9 - Weapon:Shuriken
        //      *     10 - Weapon:Pistols
        //      *     11 - Weapon:Rifle
        //      *     12 - Weapon:Bow
        //      *     13 - Weapon:Claws
        //      *     14 - Weapon:Gloves (Armour?)
        //      *     15 - Armour:Clothes
        //      *     16 - Armour:Light
        //      *     17 - Armour:Heavy
        //      *     18 - Accessory
        //      *     19 - Food
        //      *     20 - Potion
        //      *     21 - Gem
        //      *     22 - Material
        //      *     23 - Quest
        //      */
        //     $table->integer('type');
        //     $table->integer('durability')->unsigned()->nullable(); // Could be used to determine num uses?
        //     $table->integer('calories')->unsigned()->nullable();
        //     /**
        //      * Damage schools:
        //      *     1 - Normal (Physical)
        //      *     3 - Magic:Holy
        //      *     4 - Magic:Fire
        //      *     5 - Magic:Nature
        //      *     6 - Magic:Frost
        //      *     7 - Magic:Shadow
        //      *     8 - Magic:Arcane
        //      */
        //     $table->integer('damage_school')->nullable();
        //     $table->integer('damage')->unsigned()->nullable();
        //     /**
        //      * Defence schools:
        //      *     1 - Normal (Physical)
        //      *     3 - Magic:Holy
        //      *     4 - Magic:Fire
        //      *     5 - Magic:Nature
        //      *     6 - Magic:Frost
        //      *     7 - Magic:Shadow
        //      *     8 - Magic:Arcane
        //      */
        //     $table->integer('defence_school')->nullable();
        //     $table->integer('defence')->nullable(); // Negative defence increases damage taken?
        //     /**
        //      * Sizes:
        //      *     0 - XS
        //      *     1 - S
        //      *     2 - M
        //      *     3 - L
        //      *     4 - XL
        //      *     5 - XXL
        //      *     6 - XXXL
        //      *     7 - XXXXL
        //      *     8 - Stretch
        //      */
        //     $table->tinyInteger('size')->nullable();

        //     $table->timestamps();
        //     $table->softDeletes();
        // });

        // Schema::create('items', function (Blueprint $table) {
        //     $table->increments('id')->unsigned();
        //     /**
        //      * Slots: TODO
        //      *     1 - Weapon
        //      *     2 - Offhand
        //      */
        //     $table->tinyInteger('slot')->unsigned()->nullable();
        //     $table->integer('current_durability')->unsigned()->nullable(); // Use as num uses as well?
        //     $table->integer('calories_remaining')->unsigned()->nullable();
        //     $table->boolean('digesting')->default(false);
        //     $table->boolean('equipped')->default(false);
        //     $table->integer('item_template_id')->unsigned();
        //     $table->integer('unit_id')->unsigned();

        //     $table->timestamps();

        //     $table->foreign('item_template_id')->references('id')->on('item_templates')
        //         ->onUpdate('cascade')
        //         ->onDelete('cascade');
        //     $table->foreign('unit_id')->references('id')->on('units')
        //         ->onUpdate('cascade')
        //         ->onDelete('cascade');
        // });

        // // DB::statement('ALTER TABLE `inventory_items` ADD COLUMN `uuid` BINARY(16) NOT NULL AFTER `id`');

        // Schema::create('spell_templates', function (Blueprint $table) {
        //     $table->increments('id')->unsigned();
        //     $table->string('name');
        //     $table->string('tooltip')->nullable();
        //     $table->text('description')->nullable();
        //     $table->string('icon')->nullable();
        //     $table->tinyInteger('school')->nullable();
        //     $table->integer('priority')->unsigned()->default(0);
        //     $table->integer('caster_aura_id')->unsigned()->nullable();
        //     $table->integer('target_aura_id')->unsigned()->nullable();
        //     $table->integer('max_duration')->unsigned()->nullable();
        //     $table->integer('proc_chance')->unsigned()->nullable();
        //     $table->integer('charges')->unsigned()->nullable();
        //     $table->integer('level')->unsigned()->default(1);
        //     $table->integer('mana_cost')->unsigned()->default(0);
        //     $table->integer('mana_cost_pct')->unsigned()->default(0);
        //     $table->integer('max_stacks')->unsigned()->nullable();
        //     $table->integer('attributes_1')->nullable();
        //     $table->integer('attributes_2')->nullable();
        //     $table->integer('attributes_3')->nullable();
        //     $table->integer('base_dice_1')->nullable();
        //     $table->integer('base_dice_2')->nullable();
        //     $table->integer('base_dice_3')->nullable();
        //     $table->integer('base_points_1')->nullable();
        //     $table->integer('base_points_2')->nullable();
        //     $table->integer('base_points_3')->nullable();
        //     $table->integer('aura_type_1')->nullable();
        //     $table->integer('aura_type_2')->nullable();
        //     $table->integer('aura_type_3')->nullable();
        //     $table->integer('misc_value_1')->nullable();
        //     $table->integer('misc_value_2')->nullable();
        //     $table->integer('misc_value_3')->nullable();
        //     $table->integer('trigger_spell_id_1')->unsigned()->nullable();
        //     $table->integer('trigger_spell_id_2')->unsigned()->nullable();
        //     $table->integer('trigger_spell_id_3')->unsigned()->nullable();

        //     $table->timestamps();
        //     $table->softDeletes();

        //     $table->foreign('caster_aura_id')->references('id')->on('spell_templates')
        //         ->onUpdate('cascade')
        //         ->onDelete('set null');
        //     $table->foreign('target_aura_id')->references('id')->on('spell_templates')
        //         ->onUpdate('cascade')
        //         ->onDelete('set null');
        //     $table->foreign('trigger_spell_id_1')->references('id')->on('spell_templates')
        //         ->onUpdate('cascade')
        //         ->onDelete('set null');
        //     $table->foreign('trigger_spell_id_2')->references('id')->on('spell_templates')
        //         ->onUpdate('cascade')
        //         ->onDelete('set null');
        //     $table->foreign('trigger_spell_id_3')->references('id')->on('spell_templates')
        //         ->onUpdate('cascade')
        //         ->onDelete('set null');
        // });

        // Schema::create('auras', function (Blueprint $table) {
        //     $table->increments('id')->unsigned();
        //     $table->boolean('visible')->default(false);
        //     $table->integer('duration')->unsigned()->nullable();
        //     $table->integer('charges')->unsigned()->nullable();
        //     $table->integer('unit_id')->unsigned();
        //     $table->integer('spell_template_id')->unsigned();

        //     $table->timestamps();

        //     $table->foreign('unit_id')->references('id')->on('units')
        //         ->onUpdate('cascade')
        //         ->onDelete('cascade');
        //     $table->foreign('spell_template_id')->references('id')->on('spell_templates')
        //         ->onUpdate('cascade')
        //         ->onDelete('cascade');
        // });

        // Schema::create('enchants', function (Blueprint $table) {
        //     $table->increments('id')->unsigned();
        //     $table->string('name');
        //     $table->integer('duration')->unsigned()->nullable();
        //     $table->integer('charges')->unsigned()->nullable();
        //     $table->integer('item_template_id')->unsigned();
        //     $table->integer('spell_template_id')->unsigned();

        //     $table->timestamps();

        //     $table->foreign('item_template_id')->references('id')->on('item_templates')
        //         ->onUpdate('cascade')
        //         ->onDelete('cascade');
        //     $table->foreign('spell_template_id')->references('id')->on('spell_templates')
        //         ->onUpdate('cascade')
        //         ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('enchants');
        // Schema::dropIfExists('auras');
        // Schema::dropIfExists('spell_templates');
        // Schema::dropIfExists('spells');

        // Schema::dropIfExists('inventory_items');
        // Schema::dropIfExists('items');
        // Schema::dropIfExists('item_templates');
        // Schema::dropIfExists('units');

        Schema::dropIfExists('events');
        Schema::dropIfExists('tiles');
        Schema::dropIfExists('maps');
        Schema::dropIfExists('worlds');

        Schema::dropIfExists('conditions');

        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
    }
}

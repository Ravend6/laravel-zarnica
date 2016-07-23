<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('roles')->truncate();
        DB::table('roles')->insert([
            'name' => 'admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'member',
        ]);
        DB::table('roles')->insert([
            'name' => 'moderator',
        ]);
        DB::table('roles')->insert([
            'name' => 'newsmaker',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => 'zarnica',
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime,
        ]);
        DB::table('tags')->insert([
            'name' => 'tournaments',
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime,
        ]);
        DB::table('tags')->insert([
            'name' => 'cybersport',
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime,
        ]);
        DB::table('tags')->insert([
            'name' => 'games',
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime,
        ]);
    }
}

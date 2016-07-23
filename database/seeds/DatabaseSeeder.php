<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        Model::unguard();
        $this->call(RoleTableSeeder::class);
        $this->call(TagTableSeeder::class);
        // DB::table('users')->delete();

        $users = [
            ['name' => 'root', 'email' => 'root@email.com',
             'password' => Hash::make('qwerty')],
            ['name' => 'test', 'email' => 'test@email.com',
             'password' => Hash::make('qwerty')],
            ['name' => 'vova', 'email' => 'vova@email.com',
             'password' => Hash::make('qwerty')],
            ['name' => 'bob', 'email' => 'bob@email.com',
             'password' => Hash::make('qwerty')],

        ];
        // Loop through each user above and create the record for them in the database
        foreach ($users as $user) {
            $newUser = User::create($user);
            if ($user['name'] == 'root') {
                $newUser->roles()->attach(1);
            } else {
                $newUser->roles()->attach(2);
            }
        }

        Model::reguard();
    }
}

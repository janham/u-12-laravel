<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'sample',
                'email' => 'test@test.com',
                'password' => Hash::make('password123'),
            ],[
                'name' => 'sample-ni',
                'email' => 'test2@test.com',
                'password' => Hash::make('password123'),
            ],[
                'name' => 'sample-san',
                'email' => 'test3@test.com',
                'password' => Hash::make('password123'),
            ]
        ]);
    }
}

// リフレッシュして反映
//php artisan migrate:refresh --seed

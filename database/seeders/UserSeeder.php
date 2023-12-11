<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    //command run php artisan db:seed --class=UserSeeder

    public function run(): void
    {
        User::factory()->count(5)->create(); //factory
        $users =[[
                'name' => 'viralnew1',
                'email' => 'viral1@gmail.com',
                'password' => bcrypt('123456'),
            ],[
                'name' => 'disma1',
                'email' => 'disma1@gmail.com',
                'password' => bcrypt('123456'),
            ],[
                'name' => 'ketan1',
                'email' => 'ketan1@gmail.com',
                'password' => bcrypt('123456'),
            ]];
        User::insert($users);
    }
}


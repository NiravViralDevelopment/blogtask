<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Blog;

class UserSeeder extends Seeder
{
    //command run php artisan db:seed --class=UserSeeder

    public function run(): void
    {
        User::factory()->count(5)->create(); //factory
        Blog::factory()->count(10)->create();

        $users =[[
                'name' => 'viralnew1',
                'email' => 'viral11@gmail.com',
                'password' => bcrypt('123456'),
            ],[
                'name' => 'disma1',
                'email' => 'disma11@gmail.com',
                'password' => bcrypt('123456'),
            ],[
                'name' => 'ketan1',
                'email' => 'ketan11@gmail.com',
                'password' => bcrypt('123456'),
            ]];
        User::insert($users);
    }
}


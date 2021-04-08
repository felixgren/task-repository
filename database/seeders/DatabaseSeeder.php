<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Factories\CustomUserFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory(1)->create(["name" => "Felix", "username" => "felix", "email" => "felix@hello.com", "password" => '$2y$10$HvRgU67Y.04dLWnE8JwfauDM.qiXecya8YXXW.P.n9LyK6XHJy2Za', "description" => "HELLO HELLO HELLO"]);
        \App\Models\User::factory(1)->create(["name" => "Martin", "username" => "alegherix", "email" => "alegherix@gmail.com"]);

        $this->call([
            UserSeeder::class
        ]);
    }
}

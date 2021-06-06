<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();
        \App\Models\User::create([
            'username'=>'admin',
            'nickname'=>'John Doe',
            'password'=>\bcrypt('123456'),
        ]);

        \App\Models\Article::factory()->times(5)->create();

        \App\Models\Comment::factory()->times(5)->create();

        \App\Models\Feedback::factory()->times(5)->create();

        \App\Models\Category::create([
            'name'=>'历史',
            'parent_id'=>0

        ]);

        $this->call([
            SettingSeeder::class,
        ]);

    }
}

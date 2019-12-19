<?php

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
        $this->call(PostTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(FeelingTableSeeder::class);
        $this->call(TagTableSeeder::class);
    }
}

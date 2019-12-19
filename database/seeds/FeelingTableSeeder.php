<?php

use Illuminate\Database\Seeder;

class FeelingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Feeling::class, 10)-> create();
    }
}

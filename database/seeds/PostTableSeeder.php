<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $post = new Post;
        // $post->poster = "Spark";
        // $post->time = date('Y-m-d');
        // $post->view_times = 17276;
        // $post->content = "I am Spark !";
        // $post->save();

        factory(App\Post::class, 10)-> create();
    }
}

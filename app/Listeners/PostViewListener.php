<?php

namespace App\Listeners;

use App\Events\PostView;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Session\Store;

class PostViewListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  PostView  $event
     * @return void
     */
    public function handle(PostView $event)
    {
        $post = $event->post;
        if (!$this->hasViewedPost($post)) {
            $post->view_times++;
            $post->save();
          $this->storeViewedPost($post);
      }
    }

    protected function hasViewedPost($post)
    {
        return array_key_exists($post->id, $this->getViewedPost());
    }

    protected function getViewedPost()
    {
        return $this->session->get('viewed_Post', []);
    }

    protected function storeViewedPost($post)
    {
        $key = 'viewed_Post.'.$post->id;

        $this->session->put($key, time());
    }
}

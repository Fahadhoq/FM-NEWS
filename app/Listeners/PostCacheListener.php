<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Post;

class PostCacheListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        info('Event Fired');
        cache()->forget('articles');
        info(cache('articles'));
        $post = Post::select('tittle', 'content', 'status' , 'thumbnail_path', 'category_id', 'user_id', 'created_at')
                      ->where('status' , 1)
                      ->paginate(5);
        cache()->forever('articles', $post);
        info(cache('articles'));
    }
}

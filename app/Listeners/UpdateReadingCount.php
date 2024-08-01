<?php

namespace App\Listeners;

use App\Events\PostReading;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateReadingCount
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\PostReading  $event
     * @return void
     */
    public function handle(PostReading $event)
    {
        $post = Post::find($event->postId);
        if ($post) {
            $post->increment('readers_count');
        }
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostReading
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $postId;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($postId, $userId)
    {
        $this->postId = $postId;
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('posts.' . $this->postId);
    }
}


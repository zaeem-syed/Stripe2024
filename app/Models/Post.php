<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;


    protected $guraded=[];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }



    public function incrementReadersCount()
    {
        $this->increment('readers_count');
    }

    public function decrementReadersCount()
    {
        $this->decrement('readers_count');
    }

    public function getCurrentReadersCount()
    {
        return $this->readers_count; // or however you store the count
    }

}

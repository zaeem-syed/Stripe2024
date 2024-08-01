<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model=Comment::class;
    public function definition(): array
    {


            return [
                'user_id' => User::inRandomOrder()->first()->id,
                'post_id' => Post::inRandomOrder()->first()->id,
                'body' => $this->faker->paragraph,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
          ];

    }
}

<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Post::class;
    public function definition(): array
    {
        return [
              'user_id' => User::inRandomOrder()->first()->id,
              'title' => $this->faker->name,
              'body' => $this->faker->paragraph,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
        ];
    }
}

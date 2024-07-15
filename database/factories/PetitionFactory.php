<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Petition>
 */
class PetitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'title' => $this->faker->word,
             'category' => $this->faker->text(10),
             'description' => $this->faker->text(50),
             'author' => Author::inRandomOrder()->first()->name,
             'signee' =>$this->faker->numberBetween(1,1000)

        ];
    }
}

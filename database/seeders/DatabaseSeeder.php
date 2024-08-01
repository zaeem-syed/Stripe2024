<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\User;
use App\Models\Author;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Petition;
use Illuminate\Database\Seeder;
use Database\Seeders\PetitionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(5)->create();
        // // $this->call(PetitionSeeder::class);
        // Author::factory(10)->create();
        // Petition::factory(40)->create();

        // $this->call(PlanSeeder::class);
        // Post::factory(10)->create();
        // Comment::factory(20)->create();


        // $this->call(CountrySeeder::class);
        // $this->call(CitySeeder::class);
        $this->call(ShopSeeder::class);







    }
}

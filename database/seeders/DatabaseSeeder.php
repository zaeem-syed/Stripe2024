<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Author;
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
        // $this->call(PetitionSeeder::class);
        // Author::factory(10)->create();
        // Petition::factory(40)->create();
        // User::factory(5)->create();
        $this->call(PlanSeeder::class);





    }
}

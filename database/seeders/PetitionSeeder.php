<?php

namespace Database\Seeders;

use App\Models\Petition;
use Illuminate\Database\Seeder;
use Database\Factories\PetitionFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Petition::factory(40)->create();

    }
}

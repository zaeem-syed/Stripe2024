<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        City::create(['name'=> 'newyork',
        'country_id' => 1
    ]);
        City::create([
            'name' => 'manhattan',
            'country_id' => 1
        ]);
        City::create([
            'name' => 'newyork',
            'country_id' => 1
        ]);
        City::create([
            'name' => 'Hamburg',
            'country_id' => 3
        ]);
        City::create([
            'name' => 'Munich',
            'country_id' => 3
        ]);
        City::create([
            'name' => 'liverpool',
            'country_id' => 2
        ]);
        City::create([
            'name' => 'Sheffield',
            'country_id' => 2
        ]);
        City::create([
            'name' => 'Coventry',
            'country_id' => 1
        ]);
        City::create([
            'name' => 'Charlotte',
            'country_id' => 1
        ]);

    }
}

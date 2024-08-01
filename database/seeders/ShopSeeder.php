<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $city_ids=[1,2,3,4,5,6,7,8,9];
        $shops = [
            "The Golden Stitch Tailors",
            "Emerald Elegance Jewelry",
            "Bread & Butter Bakery",
            "Ruby's Jewel Box",
            "Savory Spice Kitchen",
            "The Artisan Tailor",
            "Pearl Paradise Jewelers",
            "The Pie Haven",
            "Diamond Dreams Boutique",
            "The Stitch & Sew Tailor Shop",
            "Luxe & Luster Jewelry",
            "The Gourmet Pantry",
            "Vintage Vogue Tailors",
            "Sweet Tooth Confections",
            "Sapphire Sparkle Jewels",
            "Taste of Tradition Bakery",
            "The Couture Closet Tailors",
            "Gleaming Gems Jewelry",
            "The Baker's Dozen"
        ];

        foreach($shops as $shop)
        {
             $city_id = $city_ids[array_rand($city_ids)];
            Shop::create([
                'name' => $shop,
                'city_id' => $city_id 
            ]);
        }





    }
}

<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlanSeeder extends Seeder
{

    public $model='Plan';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Plan::Create([
        //     'name' => 'Monthly subscription plan ',
        //     'slug' => 'Monthly',
        //     'stripe_plan' => 'prod_QSaZhSZFHzZnOI',
        //     'price' => 10,
        //     'description' => 'this is the monthly subscription plan which allow user to access multiple books on the e library for the time period of the month.'
        // ]);


        Plan::Create([
            'name' => 'unlimited books (Monthly) ',
            'slug' => 'unlimited-books',
            'stripe_plan' => 'prod_QTlJn24NsRCDex',
            'stripe_price' =>'price_1PcnoKJIYuloXeDYRzeqLuol',
            'price' => 15,
            'description' => 'this is the monthly subscription plan which allow user to access multiple books on the e library for the time period of the month.'
        ]);


        Plan::Create([
            'name' => 'unlimited books (yearly) ',
            'slug' => 'unlimited-yearly',
            'stripe_plan' => 'prod_QTlJn24NsRCDex',
            'stripe_price' =>'price_1PcnnDJIYuloXeDYln4xNZPS',
            'price' => 23,
            'description' => 'this is the yearly  subscription plan which allow user to access multiple books on the e library for the time period of the month.'
        ]);




    }
}

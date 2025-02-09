<?php

namespace Database\Seeders;

use App\Models\city;
use App\Models\governorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GovenorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $governorate = governorate::factory(5)->create();
        $governorate->each(function($governorate){
            city::factory(5)->create([
                'gov_id'=>$governorate->id,
            ]);
        });
    }
}

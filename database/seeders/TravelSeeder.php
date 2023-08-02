<?php

namespace Database\Seeders;

use App\Models\Travel;
use Illuminate\Database\Seeder;

class TravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Travel::factory(2)->hasTours(5)->create();
        Travel::factory(5)->hasTours(7)->create(['is_public' => true]);
        Travel::factory(1)->hasTours(17)->create();
    }
}

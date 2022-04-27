<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class locationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'location' => 'Yangon',
        ]);
        Location::create([
            'location' => 'Mandalay',
        ]);
        Location::create([
            'location' => 'Nay Pyi Taw',
        ]);
        Location::create([
            'location' => 'Taunggyi',
        ]);
        Location::create([
            'location' => 'Taunggyi',
        ]);
    }
}

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
            'location' => 'Ayeyarwady',
        ]);
        Location::create([
            'location' => 'Bago',
        ]);
        Location::create([
            'location' => 'Magway',
        ]);
        Location::create([
            'location' => 'Mandalay',
        ]);
        Location::create([
            'location' => 'Sagaing',
        ]);
        Location::create([
            'location' => 'Tanintharyi',
        ]);
        Location::create([
            'location' => 'Yangon',
        ]);
        Location::create([
            'location' => 'Chin State',
        ]);
        Location::create([
            'location' => 'Kachin State',
        ]);
        Location::create([
            'location' => 'Kayin',
        ]);
        Location::create([
            'location' => 'Kayah',
        ]);
        Location::create([
            'location' => 'Mon',
        ]);
        Location::create([
            'location' => 'Rakhine',
        ]);
        Location::create([
            'location' => 'Shan',
        ]);
    }
}

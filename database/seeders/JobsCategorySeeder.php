<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobCategory;

class JobsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobCategory::create([
            'name' => 'Sales and Marketing',
        ]);
        JobCategory::create([
            'name' => 'Software Engineer',
        ]);
        JobCategory::create([
            'name' => 'Accountant',
        ]);
    }
}

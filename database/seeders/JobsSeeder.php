<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jobs;
class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jobs::create([
            'job_title' => 'testing One Job',
            'job_description' => 'This is testing one job',
            'necessary_skills' => 'interpersonal skill',
            'pictures' => 'jpg.png',
            'location_id' => 1,
        ]);  
        Jobs::create([
            'job_title' => 'testing Job Two',
            'job_description' => 'This is testing two job',
            'necessary_skills' => 'interpersonal skill',
            'pictures' => 'jpg.png',
            'location_id' => 1,
        ]);        
    }
}
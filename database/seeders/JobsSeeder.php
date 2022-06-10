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
            'qualification' => 'interpersonal skill',
            'location_id' => 1,
            'category_id' => 1,
            'salary' => '200000',
            'township' => 'Pabedan',
            'experiences' => '2',
            'responsibilities' => 'I dont know what to add haha',
            'email_receiver' =>'1'
        ]);  
        Jobs::create([
            'job_title' => 'testing Job Two',
            'job_description' => 'This is testing two job',
            'qualification' => 'interpersonal skill',
            'location_id' => 2,
            'category_id' => 2,
            'salary' => '250000',
            'township' => 'YayKyaw',
            'experiences' => '5',
            'responsibilities' => 'I dont know what to add haha',
            'email_receiver' =>'2'
        ]);        
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmailSender;
class EmailSenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmailSender::create([
            'staff_name' => 'David',
            'sender_email' => 'davidgautam.1234@gmail.com',
        ]);
        EmailSender::create([
            'staff_name' => 'Yelinn Aung',
            'sender_email' => 'yelinnaung@neptunemm.com',
        ]);
    }
}

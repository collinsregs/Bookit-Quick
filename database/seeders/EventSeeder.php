<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;




class EventSeeder extends Seeder
{
    public function run()
    {
        Event::factory(50)->create();
    }
}

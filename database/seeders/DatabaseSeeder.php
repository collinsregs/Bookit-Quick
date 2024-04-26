<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\EventSeeder;
use Database\Seeders\TicketSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'cit2230412020@mmu.ac.ke',
            'password' => bcrypt('testuserpassword'),
            'isAdmin' => true,
        ]);
        $this->call(EventSeeder::class);
        $this->call(TicketSeeder::class);
    }
}

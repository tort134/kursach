<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Address::factory()->create([
            'city' => 'Tomsk',
            'street' => 'Kievskay'
        ]);

         \App\Models\User::factory()->create([
             'first_name' => 'Alesha',
             'last_name' => 'Timosha',
             'phone_number' => '89101119904',
             'email' => 'test@asd.com',
             'password' => 'Password123.',
             'address_id' => '1',
         ]);


    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UmrohTicket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            "name" => "Admin",
            "email" => "admin@example.com",
            "usertype" => "admin",
            "password" => Hash::make("password"),
            "email_verified_at" => now(),
            "remember_token" => Str::random(10),
        ]);

        // Create Jamaah Users
        User::create([
            'name' => 'Jamaah 1',
            'email' => 'jamaah1@example.com',
            'usertype' => 'jamaah',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Jamaah 2',
            'email' => 'jamaah2@example.com',
            'usertype' => 'jamaah',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Create Sample Umroh Tickets
        UmrohTicket::create([
            'name' => 'Ahmad Abdullah',
            'passport_number' => 'A123456789',
            'package' => 'Paket Hemat',
            'price' => 25000000,
            'departure_date' => now()->addMonths(2),
        ]);

        UmrohTicket::create([
            'name' => 'Siti Fatimah',
            'passport_number' => 'B987654321',
            'package' => 'Paket VIP',
            'price' => 35000000,
            'departure_date' => now()->addMonths(3),
        ]);

        UmrohTicket::create([
            'name' => 'Muhammad Ibrahim',
            'passport_number' => 'C456789123',
            'package' => 'Paket Premium',
            'price' => 45000000,
            'departure_date' => now()->addMonths(1),
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Timotius',
        //     'email' => 'timotius@example.com',
        //     'password'=>Hash::make('123'),
        //     'resident_number' => 64365865,
        // ]);
        Cinema::create([
            'provider' => 'XXI',
            'time' => json_encode(['15.30','18.00','21.00']),
            'theater'=>5,
            'price'=>6.5,
            'total_seat'=>50,
        ]);
        Cinema::create([
            'provider' => 'CGV',
            'time' => json_encode(['14.00','17.00','23.00']),
            'theater'=>4,
            'price'=>6.2,
            'total_seat'=>50,
        ]);
        Cinema::create([
            'provider' => 'Cinepolis',
            'time' => json_encode(['16.30','19.00','22.30']),
            'theater'=>5,
            'price'=>6.85,
            'total_seat'=>50,
        ]);
    }
}

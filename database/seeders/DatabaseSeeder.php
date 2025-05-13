<?php

namespace Database\Seeders;

use App\Models\Product;
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
        // User::factory(10)->create();

        User::create([
            'username' => 'Admin',
            'email' => 'admin@dev.com',
            'password'=> Hash::make('password'),
            'role'=> 'Admin',
            
        ]);

        User::create([
            'username' => 'Haryanto Drive',
            'email' => 'driver@dev.com',
            'password'=> Hash::make('password'),
            'role'=> 'Driver',
            
        ]);

        User::create([
            'username' => 'Budi Drive',
            'email' => 'budi@dev.com',
            'password'=> Hash::make('password'),
            'role'=> 'Driver',
            
        ]);

    }
}

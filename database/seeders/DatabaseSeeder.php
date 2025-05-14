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
            'nama' => 'Admin',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Admin',
        ]);

        User::create([
            'username' => 'Haryanto Drive',
            'email' => 'driver@dev.com',
            'password'=> Hash::make('password'),
            'role'=> 'Driver',
            'nama' => 'Haryanto Drive',
            'no_hp' => '081390420435',
            'alamat' => 'Jl. Haryanto Drive',
        ]);

        User::create([
            'username' => 'Budi Drive',
            'email' => 'budi@dev.com',
            'password'=> Hash::make('password'),
            'role'=> 'Driver',
            'nama' => 'Budi Drive',
            'no_hp' => '081234293854',
            'alamat' => 'Jl. Budi Drive',
        ]);

    }
}

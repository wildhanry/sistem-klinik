<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pendaftaran User
        User::create([
            'name' => 'Admin Pendaftaran',
            'email' => 'pendaftaran@klinik.com',
            'password' => Hash::make('password'),
            'role' => 'pendaftaran',
        ]);

        // Dokter User
        User::create([
            'name' => 'Dr. Ahmad Wijaya',
            'email' => 'dokter@klinik.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
        ]);

        // Apotek User
        User::create([
            'name' => 'Apt. Siti Nurhaliza',
            'email' => 'apotek@klinik.com',
            'password' => Hash::make('password'),
            'role' => 'apotek',
        ]);

        // Pimpinan User
        User::create([
            'name' => 'Direktur Klinik',
            'email' => 'pimpinan@klinik.com',
            'password' => Hash::make('password'),
            'role' => 'pimpinan',
        ]);
    }
}

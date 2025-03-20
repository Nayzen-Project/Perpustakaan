<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Peminjam;
use App\Models\Petugas;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\ListPeminjaman;
use App\Models\Ulasan;
use App\Models\Denda;
use App\Models\KategoriBuku;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // User::factory(10)->create();
        
         DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_confirmed' => true,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Petugas',
                'email' => 'petugas@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'petugas',
                'is_confirmed' => true,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'is_confirmed' => false,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('petugas')->insert([
            [
                'user_id' => '2',
                'nama_lengkap' => 'Sachie',
                'email' => 'sachie@gmail.com',
                'phone' => '08129876543',
                'alamat' => 'Jakarta, Indonesia',
                'role' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('petugas')->insert([
            [
                'user_id' => '1',
                'nama_lengkap' => 'Velia',
                'email' => 'velia@gmail.com',
                'phone' => '08129876541',
                'alamat' => 'Surabaya, Indonesia',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);        
    }
}

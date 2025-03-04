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
        $faker = Faker::create();

        // Seed 5 users
        $userIds = [];
        $userRoles = ['admin', 'user', 'petugas'];

        // Insert 5 users with different roles
        for ($i = 1; $i <= 5; $i++) {
            $role = $userRoles[$i % 3]; // Rotate through 'admin', 'user', 'petugas'
            $userIds[] = DB::table('users')->insertGetId([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
                'role' => $role,
            ]);
        }

        // Seed peminjams based on 'user' role from users
        $peminjamIds = [];
        $userEmails = DB::table('users')->where('role', 'user')->pluck('email')->toArray();
        foreach ($userEmails as $email) {
            $userId = DB::table('users')->where('email', $email)->value('id');
            $peminjamIds[] = DB::table('peminjams')->insertGetId([
                'nama_lengkap' => $faker->name,
                'email' => $email,
                'user_id' => $userId,
                'location' => json_encode([
                    'lat' => $faker->latitude,
                    'lng' => $faker->longitude
                ]),
                'alamat' => $faker->address,
                'phone' => $faker->phoneNumber,
            ]);
        }

        // Seed petugas based on 'petugas' role from users
        $petugasIds = [];
        $petugasEmails = DB::table('users')->where('role', 'petugas')->pluck('email')->toArray();
        foreach ($petugasEmails as $email) {
            $userId = DB::table('users')->where('email', $email)->value('id');
            $petugasIds[] = DB::table('petugas')->insertGetId([
                'user_id' => $userId,
                'email' => $email,
                'nama_lengkap' => $faker->name,
                'phone' => $faker->phoneNumber,
                'alamat' => $faker->address,
                'photo' => 'default.jpg',
                'role' => 'petugas',
            ]);
        }

        // Seed 5 buku
        $bukuIds = [];
        for ($i = 1; $i <= 5; $i++) {
            $bukuIds[] = DB::table('bukus')->insertGetId([
                'judul' => $faker->sentence(3),
                'penulis' => $faker->name,
                'penerbit' => $faker->company,
                'description' => $faker->paragraph,
                'code' => strtoupper(Str::random(10)),
                'tahun_terbit' => $faker->year,
                'jumlah' => $faker->numberBetween(5, 20),
            ]);
        }

        // Seed 5 peminjaman
        $peminjamanIds = [];
        for ($i = 1; $i <= 5; $i++) {
            $peminjamanIds[] = DB::table('peminjamen')->insertGetId([
                'peminjam_id' => $faker->randomElement($peminjamIds),
                'petugas_id' => $faker->randomElement($petugasIds),
                'tanggal_dikembalikan' => $faker->date(),
                'tanggal_pengembalian' => $faker->date(),
                'tanggal_peminjaman' => $faker->date(),
                'status' => $faker->randomElement(['dipinjam', 'dikembalikan']),
            ]);
        }

        // Seed 5 list_peminjaman
        for ($i = 1; $i <= 5; $i++) {
            DB::table('list_peminjamen')->insert([
                'peminjaman_id' => $faker->randomElement($peminjamanIds),
                'buku_id' => $faker->randomElement($bukuIds),
            ]);
        }

        // Seed 5 denda
        for ($i = 1; $i <= 5; $i++) {
            DB::table('dendas')->insert([
                'peminjaman_id' => $faker->randomElement($peminjamanIds),
                'nominal' => $faker->numberBetween(5000, 50000),
                'dibayar' => $faker->boolean,
                'status' => $faker->randomElement(['belum lunas', 'lunas']),
            ]);
        }

        // Seed 5 ulasan
        for ($i = 1; $i <= 5; $i++) {
            DB::table('ulasans')->insert([
                'peminjam_id' => $faker->randomElement($peminjamIds),
                'buku_id' => $faker->randomElement($bukuIds),
                'rating' => $faker->numberBetween(1, 5),
                'ulasan' => $faker->sentence,
            ]);
        }
    }
}

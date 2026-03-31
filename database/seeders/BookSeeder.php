<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $kategoris = Kategori::pluck('id')->toArray();

        // Admin
        User::updateOrCreate(['email' => 'admin@test.com'], [
            'name' => 'Admin Super',
            'role' => 'admin',
            'password' => Hash::make('password')
        ]);

        // Petugas
        User::updateOrCreate(['email' => 'petugas@test.com'], [
            'name' => 'Petugas Perpustakaan',
            'role' => 'petugas',
            'password' => Hash::make('password')
        ]);

        // User
        User::updateOrCreate(['email' => 'user@test.com'], [
            'name' => 'User Biasa',
            'role' => 'user',
            'password' => Hash::make('password')
        ]);

        // 50 Buku Fake
        Book::factory(50)->create([
            'kategori_id' => $faker->randomElement($kategoris),
            'stok' => $faker->numberBetween(5, 20)
        ]);
    }
}


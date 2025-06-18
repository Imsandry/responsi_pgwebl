<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder pengguna (jika kamu ingin akun admin login)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password') // bisa diganti sesuai kebutuhan
        ]);

        // Jalankan seeder untuk sekolah
        $this->call([
            SekolahSeeder::class,
        ]);
    }
}

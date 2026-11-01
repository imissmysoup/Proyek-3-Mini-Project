<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // 1. Akun Demo
    \App\Models\User::factory()->create([
        'name' => 'Pelapor Demo',
        'email' => 'pelapor@demo.com',
        'password' => bcrypt('password'),
        'role' => 'pelapor',
    ]);
    \App\Models\User::factory()->create([
        'name' => 'Pemantau Demo',
        'email' => 'pemantau@demo.com',
        'password' => bcrypt('password'),
        'role' => 'pemantau',
    ]);
    \App\Models\User::factory()->create([
        'name' => 'Koordinator Demo',
        'email' => 'koordinator@demo.com',
        'password' => bcrypt('password'),
        'role' => 'koordinator',
    ]);

    // 2. Data Sekolah
    $sekolah1 = \App\Models\Sekolah::create(['nama_sekolah' => 'SMP Harapan']);
    $sekolah2 = \App\Models\Sekolah::create(['nama_sekolah' => 'SD Nusantara']);

    // 3. Data Distribusi
    \App\Models\Distribusi::create(['sekolah_id' => $sekolah1->id, 'tanggal_distribusi' => '2026-10-20']);
    \App\Models\Distribusi::create(['sekolah_id' => $sekolah1->id, 'tanggal_distribusi' => '2026-10-21']);
    \App\Models\Distribusi::create(['sekolah_id' => $sekolah2->id, 'tanggal_distribusi' => '2026-10-20']);
}
}

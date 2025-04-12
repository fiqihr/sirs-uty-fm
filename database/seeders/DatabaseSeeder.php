<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Iklan;
use App\Models\Jam;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'hak_akses' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'Traffic',
            'email' => 'traffic@mail.com',
            'hak_akses' => 'traffic',
        ]);
        User::factory()->create([
            'name' => 'Penyiar',
            'email' => 'penyiar@mail.com',
            'hak_akses' => 'penyiar',
        ]);
        User::factory()->create([
            'name' => 'Program Director',
            'email' => 'program_director@mail.com',
            'hak_akses' => 'program_director',
        ]);

        Client::factory()->create([
            'nama_client' => 'Client 1',
        ]);

        Iklan::factory()->create([
            'id_client' => 1,
            'nama_iklan' => 'Iklan 1',
            'jumlah_putar' => 10,
            'periode_siar_mulai' => '2024-04-12',
            'periode_siar_selesai' => '2024-04-13',
        ]);
    }
}
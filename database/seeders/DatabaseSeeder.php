<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Iklan;
use App\Models\Jam;
use App\Models\RentangJam;
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

        // Client::factory()->create([
        //     'nama_client' => 'Client 1',
        // ]);

        // Iklan::factory()->create([
        //     'id_client' => 1,
        //     'nama_iklan' => 'Iklan 1',
        //     'jumlah_putar' => 10,
        //     'periode_siar_mulai' => '2024-04-12',
        //     'periode_siar_selesai' => '2024-04-13',
        // ]);

        RentangJam::factory()->createMany([
            ['rentang_jam' => '06:00 - 07:00'],
            ['rentang_jam' => '07:00 - 08:00'],
            ['rentang_jam' => '08:00 - 09:00'],
            ['rentang_jam' => '09:00 - 10:00'],
            ['rentang_jam' => '10:00 - 11:00'],
            ['rentang_jam' => '11:00 - 12:00'],
            ['rentang_jam' => '12:00 - 13:00'],
            ['rentang_jam' => '13:00 - 14:00'],
            ['rentang_jam' => '14:00 - 15:00'],
            ['rentang_jam' => '15:00 - 16:00'],
            ['rentang_jam' => '16:00 - 17:00'],
            ['rentang_jam' => '17:00 - 18:00'],
            ['rentang_jam' => '18:00 - 19:00'],
            ['rentang_jam' => '19:00 - 20:00'],
            ['rentang_jam' => '20:00 - 21:00'],
            ['rentang_jam' => '21:00 - 22:00'],
            ['rentang_jam' => '22:00 - 23:00'],
            ['rentang_jam' => '23:00 - 00:00'],
            ['rentang_jam' => '00:00 - 01:00'],
        ]);
    }
}

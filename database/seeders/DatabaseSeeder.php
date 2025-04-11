<?php

namespace Database\Seeders;

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

        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@mail.com',
        //     'hak_akses' => 'admin',
        // ]);
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
    }
}
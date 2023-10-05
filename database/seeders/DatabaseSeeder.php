<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => 'super123',
            'role' => '0',
        ]);

        \App\Models\Partai::factory()->create([
            'nama' => 'PDIP',
        ]);

        \App\Models\Partai::factory()->create([
            'nama' => 'PAN',
        ]);

        \App\Models\Partai::factory()->create([
            'nama' => 'Demokrat',
        ]);

        \App\Models\Partai::factory()->create([
            'nama' => 'PPP',
        ]);

        \App\Models\Partai::factory()->create([
            'nama' => 'Gerindra',
        ]);

        \App\Models\Caleg::factory()->create([
            'nama' => 'Prama',
        ]);
    }
}

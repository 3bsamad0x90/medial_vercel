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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //  \App\Models\User::factory()->create([
        //     'name' => '3bsamad0x90',
        //     'username' => '3bsamad0x90',
        //     'email' => 'test@admin.com',
        //     'role' => '1',
        //     'password' => bcrypt('123456789'),
        // ]);
        \App\Models\role::factory()->create([
            'name_ar' => 'أدمن',
            'name_en' => 'Admin',
            'guard' => 'admin',
        ]);
    }
}

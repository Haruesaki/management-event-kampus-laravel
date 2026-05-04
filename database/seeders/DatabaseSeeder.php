<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed roles terlebih dahulu (harus ada sebelum insert users)
        DB::table('roles')->insert([
            ['id' => 1, 'role_name' => 'Admin',   'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'role_name' => 'Panitia', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'role_name' => 'Peserta', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 2. Seed users berdasarkan role
        $users = [
            [
                'name'      => 'Administrator',
                'email'     => 'admin@gmail.com',
                'password'  => Hash::make('123'),
                'role_id'   => 1, // Admin
            ],
            [
                'name'      => 'Panitia',
                'email'     => 'panit@gmail.com',
                'password'  => Hash::make('123'),
                'role_id'   => 2, // Panitia
            ],
            [
                'name'      => 'User Peserta',
                'email'     => 'user@gmail.com',
                'password'  => Hash::make('123'),
                'role_id'   => 3, // Peserta
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

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

    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'role_name' => 'admin',   'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'role_name' => 'panitia', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'role_name' => 'peserta', 'created_at' => now(), 'updated_at' => now()],
        ]);

    
        User::factory()->create([
            'name'     => 'admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'role_id'  => 1, 
        ]);

        User::factory()->create([
            'name'     => 'panitia',
            'email'    => 'panit@gmail.com',
            'password' => Hash::make('123'),
            'role_id'  => 2, 
        ]);
        User::factory()->create([
            'name'     => 'peserta',
            'email'    => 'user@gmail.com',
            'password' => Hash::make('123'),
            'role_id'  => 3, 
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRoleId = DB::table('roles')->where('name', 'Admin')->value('id');
        $bankMiniRoleId = DB::table('roles')->where('name', 'Bank Mini')->value('id');
        $siswaRoleId = DB::table('roles')->where('name', 'Siswa')->value('id');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRoleId,
        ]);

        User::create([
            'name' => 'Bank Mini User',
            'email' => 'bankmini@example.com',
            'password' => bcrypt('password'),
            'role_id' => $bankMiniRoleId, 
        ]);

        User::create([
            'name' => 'Siswa User',
            'email' => 'siswa@example.com',
            'password' => bcrypt('password'),
            'role_id' => $siswaRoleId, // Menggunakan role_id Siswa
        ]);

        User::create([
            'name' => 'Siswa2 User',
            'email' => 'siswa2@example.com',
            'password' => bcrypt('password'),
            'role_id' => $siswaRoleId, 
        ]);
    }
}

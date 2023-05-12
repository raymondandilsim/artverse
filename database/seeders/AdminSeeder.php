<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'nomor_telepon' => '081384929223',
            'nama_provinsi' => 'admin',
            'nama_kota' => 'admin',
            'password' => Hash::make('iniakunadmin'),
            'role_id'=>1,
            'foto_profil'=>'/asset/avatar.png'
        ]);
    }
}

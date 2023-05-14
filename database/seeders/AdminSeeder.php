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
            'role_id' => 1,
            'nama' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'nomor_telepon' => '081384929223',
            'nama_provinsi' => 'admin',
            'nama_kota' => 'admin',
            'nama_jalan' => 'admin',
            'kode_pos' => 'admin',
            'password' => Hash::make('iniakunadmin'),
            'foto_profil'=>'/asset/avatar.png'
        ]);
    }
}

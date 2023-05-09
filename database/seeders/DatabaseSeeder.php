<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'nomor_telepon' => '081384929223',
            'nama_provinsi' => 'admin',
            'nama_kota' => 'admin',
            'password' => Hash::make('iniakunadmin'),
            'role'=>'Admin',
        ]);
    }
}
